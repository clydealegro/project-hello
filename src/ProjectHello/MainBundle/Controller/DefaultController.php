<?php

namespace ProjectHello\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjectHello\CoreBundle\Entity\Card;
use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Form\Type\CardType;
use Symfony\Component\HttpFoundation\Request;
use ProjectHello\CoreBundle\Services\CardService;


class DefaultController extends Controller
{
    public function createCardAction(Request $request)
    {
        $card = new Card();
        $form = $this->createForm(new CardType(), $card);

        $recipient = new User();
        $recipient->name = 'recipient';
        $card->getRecipients()->add($recipient);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // save card to database
                // send email to collaborators
                try {
                    $entityManager = $this->getDoctrine()->getEntityManager();
                    //insert card into database
                    $entityManager->persist();
                    $entityManager->flush();
                }
                catch(\Exception $e) {

                }

                //return $this->redirect($this->generateUrl('task_success'));
            }
        }

        return $this->render('ProjectHelloMainBundle:Card:create_card.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function addMessageAction()
    {
        return $this->render('ProjectHelloMainBundle:Default:add_message.html.twig');
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
                'content'   => "hi mon!<br /><br />Goodluck and best wishes!!!keep on rocking MONster!!!"
            ),
            array(
                'author'    => 'Augustianne Laurenne L. Barreta',
                'content'   => "Hi Mon, <br /><br />You've been an awesome team mate. It has been my pleasure working with you. Keep up the good work and go for the gold! <br /><br /> Here's to your new job and to the love of your life :) Keep in touch ok? <br /><br /> P.S Paukya kmi iyo balay kun makadto kmi Cebu ha?"
            ),
            array(
                'author'    => 'Joy Amor Moreno',
                'content'   => "Thanks for the short-lived friendship,mon. Actually i'm secretly glad that you're going, this time i'll be the ONLY Green Room Queen. LOL.  Kidding aside, you're such a wonderful person. I wish you all the happiness and love in this world particularly in CEBU, you deserve it. Bon Voyage!"
            )
        );

        return $this->render('ProjectHelloMainBundle:Card:view_card.html.twig', array(
            'messages' => $messages
        ));
    }
}