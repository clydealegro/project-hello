<?php

namespace ProjectHello\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function createCardAction()
    {
        return $this->render('ProjectHelloMainBundle:Default:create_card.html.twig');
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