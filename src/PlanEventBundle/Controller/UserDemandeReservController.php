<?php

namespace PlanEventBundle\Controller;
use PlanEventBundle\Entity\Reservevent;
use PlanEventBundle\Repository\ReserveventRepository;
use PlanEventBundle\Form\ReserveventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserDemandeReservController extends Controller
{

    public function UserAfficheDemandeAction()
    {
        $em = $this->getDoctrine();
        $nom = $this->getUser()->getNom();
        $tab = $em->getRepository(Reservevent::class)->findMyReservations($nom);
        return $this->render('@PlanEvent/Demande/UserAfficheDemande.html.twig', array('reservations' => $tab));
    }

    public function UserAfficheProgressDemandeAction()
    {
        $em = $this->getDoctrine();
        $nom = $this->getUser()->getNom();
        $tab = $em->getRepository(Reservevent::class)->findProgressReservations($nom);
        return $this->render('@PlanEvent/Demande/UserAfficheDemande.html.twig', array('reservations' => $tab));
    }

    public function UserAfficheRejectedDemandeAction()
    {
        $em = $this->getDoctrine();
        $nom = $this->getUser()->getNom();
        $tab = $em->getRepository(Reservevent::class)->findRejectedReservations($nom);
        return $this->render('@PlanEvent/Demande/UserAfficheDemande.html.twig', array('reservations' => $tab));
    }


    public function UserAjoutDemandeAction(Request $request)
    {
        $demande = new Reservevent();
        $test = "ajout";
        $form = $this->createForm(ReserveventType::class, $demande);
        $form = $form->handleRequest($request);
        $utilisateur = $this->getUser();
        $demande->setEtat("In Progress");
        $demande->setMailorg($utilisateur->getEmail());
        $demande->setNomorg($utilisateur->getNom());
        $demande->setPrenomorg($utilisateur->getPrenom());

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($demande);
            $em->flush();
            return $this->redirectToRoute('plan_event_UserAfficheProgressdDemande');
        }
        return $this->render('@PlanEvent/Demande/UserAjoutDemande.html.twig', array('form' => $form->createView(), 'test' => $test));
    }

    public function UserDeleteDemandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository(Reservevent::class)->find($id);
        $em->remove($demande);
        $em->flush();
        return $this->redirectToRoute('plan_event_UserAfficheDemande');
    }

    public function UserUpdateDemandeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository(Reservevent::class)->find($id);
        $test = "modify";
        $form = $this->createForm(ReserveventType::class, $demande);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('plan_event_UserAfficheDemande');
        }
        return $this->render('@PlanEvent/Demande/UserAjoutDemande.html.twig', array('form' => $form->createView(), 'test' => $test));
    }
}
