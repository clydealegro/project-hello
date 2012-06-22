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
                'message'   => "\"Hi Mon, Every code has its origin, more importantly programming is a journey thus moving on is part of it.. Goodluck in your new career pursuit.\"\n\nWeb you around :D"
            ),
            array(
                'author'    => 'Ronald Ryan L. Vy',
                'message'   => "hi mon!\n\tGoodluck and best wishes!!!keep on rocking MONster!!!"
            )
        );

        return $this->render('ProjectHelloMainBundle:Default:view_card.html.twig');
    }
}