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
        $message = \Swift_Message::newInstance();
        $message->setSubject("test");
        $message->setFrom("johnsmith@example.com");
        $message->setTo("czar.pino@goabroad.com");
        $message->setBody("The quick brown fox jumps over the lazy dog.");
        
        $this->getContainer()->get('mailer')->send($message);
    }
}