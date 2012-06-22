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
        return $this->render('ProjectHelloMainBundle:Default:view_card.html.twig');
    }
}