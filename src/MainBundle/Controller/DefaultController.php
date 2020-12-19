<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Main/Default/index.html.twig');
    }

    public function testAction($classe)
    {
        return $this->render('@Main/Default/test.html.twig',array('c'=>$classe));
    }



}
