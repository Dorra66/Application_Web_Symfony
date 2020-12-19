<?php

namespace PlanEventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PlanEventBundle:Default:index.html.twig');
    }

    public function adminpageAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_AGENT'))){
            return $this->render('@PlanEvent/Default/admin.html.twig');
        }

    }

    public function userpageAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))){
            return $this->render('@PlanEvent/Default/user.html.twig');
        }

    }
}
