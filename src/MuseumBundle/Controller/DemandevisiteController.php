<?php

namespace MuseumBundle\Controller;

use MuseumBundle\Entity\Demandevisite;
use MuseumBundle\Form\DemandevisiteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Swift_Mailer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DemandevisiteController extends Controller
{
    //Affichage de tous les demandes:
    public function showVisitRequestsAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $tab=$em->getRepository(Demandevisite::class)->findAll();
        return $this->render('@Museum/DemandeVisite/showVisitRequests.html.twig',array('Demandevisite'=>$tab));
    }}

    //Affichage d'une demande de visite en cours de traitement (Admin) :
    public function showInProgressVisitAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $tab=$em->getRepository(Demandevisite::class)->findInProgressVisit();
        return $this->render('@Museum/DemandeVisite/showVisitRequests.html.twig',array('Demandevisite'=>$tab));
    }}

    //Affichage des demandes de visite confirmées (Admin) :
    public function showConfirmedVisitAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $tab=$em->getRepository(Demandevisite::class)->findConfirmedVisit();
        return $this->render('@Museum/DemandeVisite/showConfirmedVisit.html.twig',array('Demandevisite'=>$tab));
    }}

    //Suppression d'une demande de visite confirmée (Admin):
    public function deleteConfirmedVisitAction($id){
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em=$this->getDoctrine()->getManager();
        $visit=$em->getRepository(Demandevisite::class)->find($id);
        $em->remove($visit);
        $em->flush();
        return $this->redirectToRoute('museum_showConfirmedVisitpage');
    }}

    //Suppression d'une demande de visite (Admin):
    public function deleteVisitRequestAction($id){
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em=$this->getDoctrine()->getManager();
        $visit=$em->getRepository(Demandevisite::class)->find($id);
        $em->remove($visit);
        $em->flush();
        return $this->redirectToRoute('museum_showVisitRequestspage');
    }}

    //Envoi d'une demande de visite (Client):
    public function sendVisitRequestAction(Request $request)
    {
        $VisitRequest = new Demandevisite();
        $test = "ajout";
        $form = $this->createForm(DemandevisiteType::class, $VisitRequest);
        $form->remove('etatdv')->remove('nomresponsabled');
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $VisitRequest->setSource($this->getUser()->getNom().' '.$this->getUser()->getPrenom());
            //$VisitRequest->getNomresponsabled($this->getUser()->getNom()+$this->getUser()->getPrenom());
            $VisitRequest->setEtatdv('In progress');
            $person=$this->getUser();
            $VisitRequest->setNomresponsabled($person->getNom()." ".$person->getPrenom());
            $em = $this->getDoctrine()->getManager();
            $em->persist($VisitRequest);
            $em->flush();
            return $this->redirectToRoute('museum_showMyVisitRequestspage');
        }
        return $this->render('@Museum/DemandeVisite/sendVisitRequest.html.twig', array('form' => $form->createView(), 'Request' => $VisitRequest ,'test'=>$test));
    }

    //Confirmer une demande visite (Admin):
    public function confirmRequestAction($id){

        $em=$this->getDoctrine()->getManager();
        $request=$em->getRepository(Demandevisite::class)->find($id);
        $request->setEtatdv('Confirmed');
        //Envoi d'un mail:
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('monguide07@gmail.com')
            ->setPassword('so what00112233')
        ;

        /*
        You could alternatively use a different transport such as Sendmail:

        // Sendmail
        $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
        */

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message('Reply for the museum visit request'))
            ->setFrom('monguide07@gmail.com')
            ->setTo([$request->getMaild()])
            ->setBody('Dear '.$request->getNomresponsabled().', your visit request is confirmed. You"re welcome and thanks for choosing us.')
        ;

        // Send the message
        $mailer->send($message);
        ///////////////////
        $em->flush();
        return $this->redirectToRoute('museum_showVisitRequestspage');
    }

    //Refuser une demande visite (Admin):
    public function refuseRequestAction($id){
        $em=$this->getDoctrine()->getManager();
        $request=$em->getRepository(Demandevisite::class)->find($id);
        $request->setEtatdv('Refused');
        //Envoi d'un mail:
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('monguide07@gmail.com')
            ->setPassword('so what00112233')
        ;

        /*
        You could alternatively use a different transport such as Sendmail:

        // Sendmail
        $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
        */

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message('Reply for the museum visit request'))
            ->setFrom('monguide07@gmail.com')
            ->setTo([$request->getMaild()])
            ->setBody('Dear '.$request->getNomresponsabled().', your visit request is refused. Try to change the date of visit, we hope it will be confirmed the next time. Thanks.')
        ;

        // Send the message
        $mailer->send($message);
        ///////////////////
        $em->flush();
        return $this->redirectToRoute('museum_showVisitRequestspage');
    }
    //Affichage de mes demandes de visite (Client):
    public function showMyVisitRequestsAction()
    {
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $person=$this->getUser();
        $tab=$em->getRepository(Demandevisite::class)->findMyRequests($person->getNom()." ".$person->getPrenom());
        return $this->render('@Museum/DemandeVisite/showMyVisitRequests.html.twig',array('Demandevisite'=>$tab));
    }

    //----------------------------------------------------Mobile:Demande de visite(Client)------------------------------------------------------//
    //Affichage de mes demandes de visite (Client):
    public function showMyVisitRequestsMobileAction($person)
    {
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        //$person=$this->getUser();
        //$user=$person->getNom()." ".$person->getPrenom();
        $tab=$em->getRepository(Demandevisite::class)->findMyRequests($person);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tab);
        return new JsonResponse($formatted);
    }

    //Envoi d'une demande de visite (Client):
    public function sendVisitRequestMobileAction(Request $request)
    {
        $VisitRequest = new Demandevisite();
        $VisitRequest->setSource($request->get('source'));//$this->getUser()->getNom().' '.$this->getUser()->getPrenom()
        $VisitRequest->setNomorganismed($request->get('nomOganism'));
        //$person=$this->getUser();
        $VisitRequest->setNomresponsabled($request->get('nomResp'));//$person->getNom()." ".$person->getPrenom()
        $VisitRequest->setNumteld($request->get('numTel'));
        $VisitRequest->setMaild($request->get('mail'));
        $VisitRequest->setAddpostaled($request->get('addPostal'));
        $VisitRequest->setDatevisited(new \DateTime($request->get('dateVisit')));
        $VisitRequest->setHeurevisited($request->get('hourVisit'));
        $VisitRequest->setNbrevisiteursd($request->get('nbreVisitors'));
        $VisitRequest->setEtatdv($request->get('etat'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($VisitRequest);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($VisitRequest);
        return new JsonResponse($formatted);
    }

}
