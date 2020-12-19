<?php

namespace PlanEventBundle\Controller;

use PlanEventBundle\Entity\Event;
use PlanEventBundle\Entity\Participation;
use PlanEventBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Process\PhpProcess;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class EventController extends Controller
{
    public function afficheEventAction()
    {
        if (($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))) {
            throw new AccessDeniedException('Access Denied!!!!!');
        } else {
            $em = $this->getDoctrine();
            $tab = $em->getRepository(Event::class)->findAll();
            return $this->render('@PlanEvent/Event/afficheEvent.html.twig', array('events' => $tab));
        }
    }

    public function ajoutEventAction(Request $request)
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $event = new Event();
        $test = "ajout";
        $form = $this->createForm(EventType::class, $event);


        $form = $form->handleRequest($request);
        if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();
                return $this->redirectToRoute('plan_event_afficheEvent');


        }
        return $this->render('@PlanEvent/Event/ajoutEvent.html.twig', array('form' => $form->createView(), 'test' => $test));
    }}

    public function updateEventAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($id);
        $test = "modify";
        $form = $this->createForm(EventType::class, $event);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('plan_event_afficheEvent');
        }

        return $this->render('@PlanEvent/Event/ajoutEvent.html.twig', array('form' => $form->createView(), 'test' => $test));
    }

    public function deleteEventAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('plan_event_afficheEvent');

    }




}