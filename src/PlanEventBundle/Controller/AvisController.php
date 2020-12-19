<?php

namespace PlanEventBundle\Controller;

use PlanEventBundle\Entity\Avis;
use PlanEventBundle\Entity\Event;
use PlanEventBundle\Entity\Participation;
use PlanEventBundle\Form\AvisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AvisController extends Controller
{
    public function ajoutAvisAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $participation= $em->getRepository(Participation::class)->find($id);
        $avis = new Avis();
        $test = "ajout";
        $avis->setIduser($this->getUser());
        $avis->setIdevent($participation->getIdevent());
        $form = $this->createForm(AvisType::class, $avis);
        $form = $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($avis);
            $em->flush();
            return $this->redirectToRoute('plan_event_UserAfficheAvis');
        }
        return $this->render('@PlanEvent/Avis/UserAjoutAvis.html.twig', array('form' => $form->createView(), 'test' => $test));
    }

    public function UserAfficheAvisAction()
    {
        $em = $this->getDoctrine();
        $tab = $em->getRepository(Avis::class)->MyFeed($this->getUser()->getId());
        return $this->render('@PlanEvent/Avis/UserAfficheAvis.html.twig', array('avis' => $tab));
    }

    public function UserDeleteAvisAction($id){
        $em = $this->getDoctrine()->getManager();
        $avis = $em->getRepository(Avis::class)->find($id);
        $em->remove($avis);
        $em->flush();
        return $this->redirectToRoute('plan_event_UserAfficheAvis');
    }

    public function AfficheAvisAction()
    {
        $em = $this->getDoctrine();
        $tab = $em->getRepository(Avis::class)->findAll();
        return $this->render('@PlanEvent/Avis/AfficheAvis.html.twig', array('avis' => $tab));

    }

    public function DeleteAvisAction($id){
        $em = $this->getDoctrine()->getManager();
        $avis = $em->getRepository(Avis::class)->find($id);
        $em->remove($avis);
        $em->flush();
        return $this->redirectToRoute('plan_event_AfficheAvis');
    }

}
