<?php

namespace PlanEventBundle\Controller;
use PlanEventBundle\Form\SalleType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use PlanEventBundle\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SalleController extends Controller
{
    public function afficheSalleAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
            $em = $this->getDoctrine();
            $tab = $em->getRepository(Salle::class)->myfindSalle();
            return $this->render('@PlanEvent/Salle/afficheSalle.html.twig', array('salles' => $tab));
        }


    }

    public function ajoutSalleAction(Request $request)
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $salle = new Salle();
        $test = "ajout";
        $form = $this->createForm(SalleType::class,$salle);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salle);
            $em->flush();
            return $this->redirectToRoute('plan_event_afficheSalle');
        }
        return $this->render('@PlanEvent/Salle/ajoutSalle.html.twig', array('form' => $form->createView(), 'test' => $test));
    }}

    public function deleteSalleAction($id)
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em = $this->getDoctrine()->getManager();
        $salle = $em->getRepository(Salle::class)->find($id);
        $em->remove($salle);
        $em->flush();
        return $this->redirectToRoute('plan_event_afficheSalle');

    }}

    public function updateSalleAction($id, Request $request)
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em = $this->getDoctrine()->getManager();
        $salle = $em->getRepository(Salle::class)->find($id);
        $test = "modify";
        $form = $this->createForm(SalleType::class, $salle);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('plan_event_afficheSalle');
        }

        return $this->render('@PlanEvent/Salle/ajoutSalle.html.twig', array('form' => $form->createView(), 'test' => $test));
    }}
}


