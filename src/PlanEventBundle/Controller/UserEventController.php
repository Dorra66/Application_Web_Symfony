<?php

namespace PlanEventBundle\Controller;

use PlanEventBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserEventController extends Controller
{
    public function UserAfficheEventAction()
    {
        $em = $this->getDoctrine();
        $tab = $em->getRepository(Event::class)->findAll();
        return $this->render('@PlanEvent/Event/UserAfficheEvent.html.twig', array('events' => $tab));
    }
}
