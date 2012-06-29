<?php

namespace ProjectHello\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjectHello\CoreBundle\Entity\Card;
use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Form\Type\CardType;
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
            'registerAction' => $this->generateUrl('register')
        ));
    }

    public function dashboardAction()
    {
        return $this->render('ProjectHelloMainBundle:Default:dashboard.html.twig');
    }


    public function createCardAction()
    {
        $card = new Card();
        //$form = $this->createForm(new CardType(), $card);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            /*$form->bindRequest($request);

            if ($form->isValid()) {
                try {
                    $entityManager = $this->getDoctrine()->getEntityManager();
                    //insert card into database
                    $entityManager->persist($card);
                    $entityManager->flush();

                    // send email to collaborators
                    foreach ($card->getRecipients() as $recipient) {
                        $tokenService = new TokenGeneratorService();
                        $link = $tokenService->getEncryptedToken(array(
                            'email' => $recipient->getEmailAddress(),
                            'card' => $card->getId()
                        ));

                        $message = \Swift_Message::newInstance()
                            ->setSubject('You are a Collaborator on Project Hello')
                            ->setFrom('test@test.com')
                            ->setTo('mercy.honor@goabroad.com')
                            ->setBody($this->renderView('ProjectHelloMainBundle:Mail:collaborator.html.twig', array('name' => $recipient->getFirstName(), 'link' => $link)));
                        $this->get('mailer')->send($message);
                    }

                    $this->get('session')->setFlash('card-notice', 'Your card has been sent to your collaborators. Thank you!');

                }
                catch(\Exception $e) {
                    $this->get('session')->setFlash('card-notice', 'An error occurred!');
                }

                $this->get('session')->setFlash('card-notice', 'Please fill all required fields!');
                return $this->redirect($this->generateUrl('card_create'));
            }*/
            return $this->redirect($this->generateUrl('add_message'));
        }
        return $this->render('ProjectHelloMainBundle:Default:create_card.html.twig');

        /*return $this->render('ProjectHelloMainBundle:Card:create_card.html.twig', array(
            'form' => $form->createView()
        ));*/
    }

    public function addMessageAction()
    {
        return $this->render('ProjectHelloMainBundle:Card:add_message.html.twig');
    }

    /**
     * View card.
     */
    public function viewCardAction()
    {
        $request = $this->getRequest();

        $cardRepo = $this->getDoctrine()->getRepository(
                'ProjectHelloCoreBundle:Card');
        $card = $cardRepo->find($request->get('card_id'));

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