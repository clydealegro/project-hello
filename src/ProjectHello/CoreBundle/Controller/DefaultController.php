<?php

namespace ProjectHello\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('ProjectHelloCoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
