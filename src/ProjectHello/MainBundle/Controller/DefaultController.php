<?php

namespace ProjectHello\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjectHello\CoreBundle\Entity\Card;
use ProjectHello\CoreBundle\Entity\CardRecipient;
use ProjectHello\CoreBundle\Entity\CardRecipientRepository;
use ProjectHello\CoreBundle\Entity\Message;
use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Form\Type\CardType;
use ProjectHello\CoreBundle\Form\Type\MessageType;
use ProjectHello\CoreBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ProjectHello\CoreBundle\Services\CardService;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class DefaultController extends Controller
{
    public function homepageAction()
    {
        return $this->render('ProjectHelloMainBundle:Card:homepage.html.twig', array(
            'registerAction' => $this->generateUrl('register'),
            'loginAction' => $this->generateUrl('login_check'),
        ));
    }

    public function dashboardAction()
    {
        return $this->render('ProjectHelloMainBundle:Default:dashboard.html.twig');
    }


    public function createCardAction()
    {
        $card = new Card();
        $card->setDateCreated(new \DateTime('now'));
        $card->setSendingDate(new \DateTime('now'));

        $form = $this->createForm(new CardType(), $card);
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                try {
                    $creator = $this->get('security.context')->getToken()->getUser();
                    $parameters = $request->request->get('card');
                    
                    $entityManager = $this->getDoctrine()->getEntityManager();
                    $card->setCreator($creator);
                    $card->setSendingDate(new \DateTime($parameters['sendingDate']));
                    
                    $token = $this->get('token_service')->getEncryptedToken(
                            array (
                                'creator_id'    => $card->getCreator()->getId(),
                                'date_created'  => date('Y-m-d H:i:s')
                            ));
                    $card->setGuestToken($token);
                    $entityManager->persist($card);
                    
                    $recipient = $this->get('user_service')->retrieveUserByEmailAddress($parameters['recipientEmailAddress']);
                    if (!$recipient) {
	                	$recipient = new User();
	                    $recipient->setEmailAddress($parameters['recipientEmailAddress']);
	                    $entityManager->persist($recipient);    
                    }

                    $cRecipient = new CardRecipient();
                    $cRecipient->setCard($card);
                    $cRecipient->setRecipient($recipient);
                    $cRecipient->setRecipientName($parameters['recipientName']);
                    $entityManager->persist($cRecipient);

                    $cMessage = new Message();
                    $cMessage->setMessage($parameters['message']);
                    $cMessage->setAuthorName($parameters['creatorName']);
                    $cMessage->setAuthor($creator);
                    $cMessage->setCard($card);
                    $entityManager->persist($cMessage);

                    $entityManager->flush();

                    // send email to collaborators
                    foreach ($parameters['collaborators'] as $collaborator) {
                        $tokenService = $this->get('token_service');
                        $link = $tokenService->getEncryptedToken(array(
                            'email' => $collaborator['email'],
                            'name' => $collaborator['name'],
                            'card' => $card->getId()
                        ));

                        $message = \Swift_Message::newInstance()
                            ->setSubject('You are a Collaborator on Project Hello')
                            ->setFrom(array($creator->getEmailAddress() => $parameters['creatorName']))
                            ->setTo(array($collaborator['email'] => $collaborator['name']))
                            ->setBody($this->renderView('ProjectHelloMainBundle:Mail:collaborator_mail.html.twig', array(
                                'name' => $collaborator['name'],
                                'recipient' => $parameters['recipientName'],
                                'creator' => $parameters['creatorName'],
                                'instruction' => $parameters['instruction'],
                                'link' => $this->generateUrl('add_message', array('link' => $link), true),
                        )), 'text/html');
                        $this->get('mailer')->send($message);
                    }

                    $this->get('session')->setFlash('card-notice', 'Your card has been sent to your collaborators. Thank you!');
                    return $this->redirect($this->generateUrl('dashboard'));

                }
                catch(\Exception $e) {
                	$error = $this->get('kernel')->isDebug() ? $e->getMessage() : 'An error occurred! Please try again!';
                    $this->get('session')->setFlash('card-notice', $error);
                }
            }
            $this->get('session')->setFlash('card-notice', 'Please fill all required fields! ');
        }

        return $this->render('ProjectHelloMainBundle:Card:create_card_new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function addMessageAction()
    {
        $request = $this->getRequest();
        if ($encryptLink = $request->query->get('link')) {
            $message = new Message();

            $form = $this->createForm(new MessageType(), $message);
            $link = $this->get('token_service')->getDecryptedToken($encryptLink);
            
            parse_str($link, $parameters);
            $email = isset($parameters['email']) ? $parameters['email'] : null;
            $name = isset($parameters['name']) ? $parameters['name'] : null;
            $cardId = isset($parameters['card']) ? $parameters['card'] : null;
            
            if ($user = $this->get('security.context')->getToken()->getUser()) {
	            if (is_callable(array($user, 'getEmailAddress')) && $user->getEmailAddress() != $email) {
		            throw $this->createNotFoundException('You are on the wrong page.');
	            }
            }
            $card = $this->getDoctrine()->getRepository('ProjectHelloCoreBundle:Card')->find($cardId);
            
            // todo: check if collaborator has already submitted the form
            if (!$email || !$name || !$card) {
                throw $this->createNotFoundException('You are on the wrong page.');
            }
            if ($card->getSendingDate() < new \DateTime('now')){
	            throw $this->createNotFoundException('This card has expired.');
            }
            $recipients = array();
            $cRecipients = $this->get('doctrine')->getEntityManager()->getRepository('ProjectHelloCoreBundle:CardRecipient')->findBy(array('card' => $cardId));
            foreach ($cRecipients as $cRecipient) {
                $recipients[] = $cRecipient->getRecipientName();
            }

            if ($request->getMethod() == 'POST') {
                $form->bindRequest($request);

                if ($form->isValid()) {
                    try {
                        $entityManager = $this->getDoctrine()->getEntityManager();

                        $collaborator = $this->get('user_service')->retrieveUserByEmailAddress($email);
                        if (!$collaborator) {
	                    	$collaborator = new User();
	                        $collaborator->setEmailAddress($email);
	                        $entityManager->persist($collaborator);    
                        }
                        
                        $message->setAuthorName($name);
                        $message->setAuthor($collaborator);
                        $message->setCard($card);
                        $entityManager->persist($message);

                        $entityManager->flush();
                        
                        if ($request->isXmlHttpRequest()) {
	                        $response = new Response(json_encode(array('message' => 'Thank you for submitting your message!')));
	                        $response->headers->set('Content-Type', 'application/json');
	                        
	                        return $response;
                        }
                    }
                    catch(\Exception $e) {
                    	if ($request->isXmlHttpRequest()) {
                    		$error = $this->get('kernel')->isDebug() ? $e->getMessage() : 'An error occurred! Please try again!';
	                    	$response = new Response(json_encode(array('error' => $error)), 500);
	                        $response->headers->set('Content-Type', 'application/json');
	                        
	                        return $response;
                    	}
                    	else {
	                    	$this->get('session')->setFlash('card-notice', $e->getMessage());	
                    	}
                    }
                }
                $this->get('session')->setFlash('card-notice', 'Please fill all required fields!');
            }

            return $this->render('ProjectHelloMainBundle:Card:add_message.html.twig', array(
                'collaborator_name' => $name,
                'recipient_name' => implode(',', $recipients),
                'form' => $form->createView(),
                'add_message_action' => $this->generateUrl('add_message', array('link' => $encryptLink))
            ));
        }
        else {
            throw $this->createNotFoundException('You are on the wrong page.');
        }
    }

    /**
     * View card.
     */
    public function guestViewCardAction()
    {
        $cardRepo = $this->getDoctrine()->getRepository(
                'ProjectHelloCoreBundle:Card');
        
        // TODO refactor retrieve by token -> this is slow since
        // token is not indexed
        $card = $cardRepo->findOneBy(
                array ('guestToken' => str_replace(' ', '+', $_GET['token'])));
        
        if (! $card) {

            throw $this->createNotFoundException(
                    'Sorry the page does not exist.');
        }

        $messageRepo = $this->getDoctrine()->getRepository(
                'ProjectHelloCoreBundle:Message');
        $messages = $messageRepo->findBy(array ('card' => $card->getId()));

        $crRepo = $this->getDoctrine()->getRepository(
                'ProjectHelloCoreBundle:CardRecipient');
        $cardRecipient = $crRepo->findOneBy(array ('card' => $card->getId()));

        return $this->render('ProjectHelloMainBundle:Card:view_card.html.twig',
                array(
                    'messages'      => $messages,
                    'recipientName' => $cardRecipient->getRecipientName()
                ));
    }

    public function registerUserAction()
    {
        $error = '';
        $request = $this->get('request')->request->get('user');

        $emailAddress = $request['emailAddress'];
        $password = $request['password'];

        $user = $this->get('user_service')->retrieveUserByEmailAddress($emailAddress);

        if ($user && $user->isVerified()) {
            $error = 'Email address has been registered already.';
        } else {
            $token = $this->get('token_service')->getEncryptedToken(array(
                'emailAddress'  => $emailAddress,
                'password'      => $password
            ));

            $token = 'http://'.$_SERVER['SERVER_NAME'].$this->generateUrl('verify_account').'?token='.$token;

            $message = \Swift_Message::newInstance()
                ->setSubject('Confirm your Registration')
                ->setFrom('support@fundmytravel.com')
                ->setTo($emailAddress)
                ->setBody($this->renderView('ProjectHelloMainBundle:Card:email.html.twig', array(
                    'email_address' => $emailAddress,
                    'token'         => $token
                )), 'text/html');
            $this->get('mailer')->send($message);
        }

        $response = new Response(json_encode(array('error' => $error)));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function verifyAccountAction()
    {
        $decryptedToken = $this->get('token_service')->getDecryptedToken(str_replace(' ', '+', $_GET['token']));

        $parameters = array();
        foreach (explode('&', $decryptedToken) as $each) {
            $decryptedItem = explode('=', $each);
            $parameters[$decryptedItem[0]] = $decryptedItem[1];
        }

        $user = $this->get('user_service')->retrieveUserByEmailAddress($parameters['emailAddress']);

        if (is_null($user) || !$user->isVerified()) {
            $salt = md5(time());
            $password = $this->get('string_util')->encodePassword($parameters['password'], $salt);

            if (!$user) {
                $user = new User();
                $user->setEmailAddress($parameters['emailAddress']);
            }

            $user->setSalt($salt);
            $user->setPassword($password);
            $user->setDateRegistered(new \DateTime('now'));

            $role = $this->get('doctrine')->getEntityManager()->getRepository('ProjectHelloCoreBundle:Role')->findOneBy(array(
                'name' => 'ROLE_MEMBER'
            ));
            $user->addRole($role);

            $entityManager = $this->get('doctrine')->getEntityManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // log in user
            $this->get('security.context')->setToken(
                new UsernamePasswordToken($user, $user->getPassword(), 'main', array('ROLE_MEMBER'))
            );

            $this->get('session')->set('user', $this->get('security.context')->getToken()->getUser());

            return $this->redirect($this->generateUrl('dashboard'));
        } else {
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
}