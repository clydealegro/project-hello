<?php

namespace ProjectHello\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjectHello\CoreBundle\Entity\Card;
use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Form\Type\CardType;
use ProjectHello\CoreBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use ProjectHello\CoreBundle\Services\CardService;


class DefaultController extends Controller
{
    public function homepageAction()
    {
        return $this->render('ProjectHelloMainBundle:Card:homepage.html.twig');
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

    public function viewCardAction()
    {
        $messages = array(
            array(
                'author'    => 'Farly & Czar',
                'content'   => "\"Hi Mon, Every code has its origin, more importantly programming is a journey thus moving on is part of it.. Goodluck in your new career pursuit.\"<br /><br />Web you around :D"
            ),
            array(
                'author'    => 'Ronald Ryan L. Vy',
                'content'   => "hi mon!<br /><br /> &nbsp; &nbsp; &nbsp; Goodluck and best wishes!!!keep on rocking MONster!!!"
            ),
            array(
                'author'    => 'Augustianne Laurenne L. Barreta',
                'content'   => "Hi Mon, <br /><br />You've been an awesome team mate. It has been my pleasure working with you. Keep up the good work and go for the gold! <br /><br /> Here's to your new job and to the love of your life :) Keep in touch ok? <br /><br /> P.S Paukya kmi iyo balay kun makadto kmi Cebu ha?"
            ),
            array(
                'author'    => 'Joy Amor Moreno',
                'content'   => "Thanks for the short-lived friendship,mon. Actually i'm secretly glad that you're going, this time i'll be the ONLY Green Room Queen. LOL.  Kidding aside, you're such a wonderful person. I wish you all the happiness and love in this world particularly in CEBU, you deserve it. Bon Voyage!"
            ),
            array(
                'author'    => 'Jean',
                'content'   => "\"Balik hit Sports Fest. Waray na daw kami hini MVP. We will miss you. :) \""
            ),
            array(
                'author'    => 'Desiree Lynn C. Blanco',
                'content'   => "Kuya Mon, <br /><br /> &nbsp; &nbsp; &nbsp; GO FOR GOLD... FOLLOW YOUR HEART... hahaha. Blit Kuya, I know na bisan ka kumain, you'll always boom and prosper. You are so blessed with a good heart. Honestly, I feel bad and sad na you'll be leaving GAP. You're such a genuine person. Thank you for the friendship. You'll always be in my prayers. Take care and God bless you always."
            ),
            array(
                'author'    => 'Naldz',
                'content'   => "Salamat Mon!"
            ),
            array(
                'author'    => 'Eric Burabod',
                'content'   => "Hey, Mon <br /> <br />Ahm they said your going to Cebu, and i would like to say good luck and have a great time in cebu its really a nice place...
                even thought expensive it lifestyle hehehe basta maupay it work no worries ingat and GOD bless!!!...Have a nice trip! <br /><br /> --^^---^^---^---^--^--^^---"
            ),
            array(
                'author'    => 'Vanessa',
                'content'   => "Mon - my former crush haha! take care and God bless you always"
            ),
            array(
                'author'    => 'Chris',
                'content'   => "Mon, You are one of the nicest people I know. I wish you all the success not only in your career but also in your personal life. God bless in all of your endeavors."
            ),
            array(
                'author'    => 'Mercy',
                'content'   => "Monster, <br /><br /> Thanks ha tanan, <br /> Sorry ha tanan... <br /> Pag-opay nala, <br /> Kon kumain kman."
            ),
            array(
                'author'    => 'Neri',
                'content'   => "Kuya Mon, <br /><br /> &nbsp; &nbsp; &nbsp; Thank you ha tanan nga memories, laughter and kung anu-ano pa.. We'll miss you.. God bless!"
            ),
            array(
                'author'    => 'Clyde',
                'content'   => "Boi goodluck sa imohang new endeavors and love life. Don't forget to keep in touch. We will miss you."
            ),
            array(
                'author'    => 'Noel',
                'content'   => 'Hi Mon, good luck, sure naman ak na maging successful ka ngadto kay maupay tim work ethics ngan technical skills pero ayaw pagduro duro, burubisita la ngadi kay ma one game kita, hahahaha....'
            )
        );

        return $this->render('ProjectHelloMainBundle:Card:view_card.html.twig', array(
            'messages'      => $messages,
            'recipientName' => 'Mon Abilar'
        ));
    }

    // an pag-verify na ini hit email
    public function registerUserAction($emailAddress, $password)
    {
        /*$request = $this->get('request')->request->get('user');

        $emailAddress = $request['emailAddress'];
        $password = $request['password'];*/

        $user = $this->get('user_service')->retrieveUserByEmailAddress($emailAddress);

        if ($user) {

        } else {

        }
    }
}