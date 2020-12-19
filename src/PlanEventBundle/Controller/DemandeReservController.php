<?php

namespace PlanEventBundle\Controller;

use PlanEventBundle\Entity\Reservevent;
use PlanEventBundle\Entity\Event;
use PlanEventBundle\Repository\ReserveventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DemandeReservController extends Controller
{
    public function AfficheDemandeAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em = $this->getDoctrine();
        $tab = $em->getRepository(Reservevent::class)->findReservations();
        return $this->render('@PlanEvent/Demande/AfficheDemande.html.twig', array('demandes' => $tab));
    }}

    public function confirmerDemandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository(Reservevent::class)->find($id);
        $event= new Event();
        $event->setNomevent($demande->getNomreserv());
        $event->setCategorieevent($demande->getCategoriereserv());
        $event->setNbrplacedispo($demande->getNbrplace());
        $event->setDateevent($demande->getDatereserv());
        $event->setHeureevent($demande->getHeure());
        $event->setAffiche($demande->getAffiche());
        $demande->setEtat("Confirmed");
        $em->persist($event);
        $em->flush();
            return $this->redirectToRoute('plan_event_AfficheDemande');
        }

    public function rejeterDemandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository(Reservevent::class)->find($id);

        $demande->setEtat("Rejected");
        $em->flush();
        return $this->redirectToRoute('plan_event_AfficheDemande');
    }
}
