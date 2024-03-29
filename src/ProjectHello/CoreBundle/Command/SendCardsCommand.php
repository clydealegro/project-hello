<?php

namespace ProjectHello\CoreBundle\Command;

use
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface
;

/**
 * Sends card emails due the current date.
 *
 * @author projecthello
 */
class SendCardsCommand extends \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
{
    /**
     * Command configuration.
     */
    protected function configure()
    {
        parent::configure();
        
        $this->setName('ProjectHello:sendCards');
        $this->setDescription('Send emails of cards due today.');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        $cardRepo = $doctrine->getRepository('ProjectHelloCoreBundle:Card');
        $crRepo = $doctrine->getRepository('ProjectHelloCoreBundle:CardRecipient');
        
        // retrieve cards with the current date's sending date
        $cards = $cardRepo->findBy(array (
            'sendingDate' => new \DateTime(date('Y-m-d'))));
        
        foreach ($cards as $card) {
            
            $link = $this->getContainer()->get('router')->generate(
                    'guest_view_card');
            
            $link = 'http://www.projecthello.com.local' . $link . '?token='
                    . $card->getGuestToken();
            
            // retrieve recipients
            $cardRecipients = $crRepo->findAllJoinedToUsersByCardId(
                    $card->getId());
            
            $recipientEmails = array ();
            $recipientNames = array ();
            
            foreach ($cardRecipients as $cardRecipient) {
                
                $recipientNames[] = $cardRecipient->getRecipientName();
                $recipientEmails[] = $cardRecipient->getRecipient()
                        ->getEmailAddress();
            }
            
            $message = \Swift_Message::newInstance()
                ->setSubject('A Card For You')
                ->setFrom('projecthello@clydealegro.me', 'ProjectHello')
                ->setTo($recipientEmails)
                ->setBody($this->getContainer()->get('templating')->render(
                        'ProjectHelloMainBundle:Card:card_email.html.twig',
                        array(
                            'recipients'    => implode(', ', $recipientNames),
                            'link'          => $link
                        )), 'text/html');
            try{
            	$this->getContainer()->get('mailer')->send($message);
            	$output->writeln('card: '.$card->getId().' sent to: '.implode(', ', $recipientEmails));
            }
            catch (Exception $e) {
	        	$output->writeln($e->getMessage());
            }
            
        }
    }
}