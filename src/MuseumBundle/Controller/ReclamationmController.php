<?php

namespace MuseumBundle\Controller;

use MuseumBundle\Entity\Reclamationm;
use MuseumBundle\Form\ReclamationmType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;

class ReclamationmController extends Controller
{
    //Affichage de tous les reclamations:
    public function showClaimsAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $tab=$em->getRepository(Reclamationm::class)->findAll();
        return $this->render('@Museum/ReclamationMuseum/showClaims.html.twig',array('Reclamations'=>$tab));
    }}

    //Suppression d'une reclamation (Admin):
    public function deleteClaimAction($id){
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository(Reclamationm::class)->find($id);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('museum_showClaimspage');
    }}

    //Envoi d'une reclamation (Client):
    public function sendClaimAction(Request $request)
    {
        $claim = new Reclamationm();
        $test = "ajout";
        $form = $this->createForm(ReclamationmType::class, $claim);
        $form->remove('idsource')->remove('rolesource')->remove('datereclamation')->remove('statutsreclamation')->remove('reponsereclamation')->remove('destinationreclamation');
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $person=$this->getUser();
            $claim->setIdsource($person->getNom()." ".$person->getPrenom());
            $claim->setStatutsreclamation('Not Seen yet');
            $mydate=getdate(date("U"));
            $claim->setDatereclamation("$mydate[weekday] $mydate[mday] $mydate[month] $mydate[year], $mydate[hours]:$mydate[minutes]:$mydate[seconds]");
            $em = $this->getDoctrine()->getManager();
            $em->persist($claim);
            $em->flush();
            return $this->redirectToRoute('museum_showMyClaimspage');
        }
        return $this->render('@Museum/ReclamationMuseum/sendClaim.html.twig', array('form' => $form->createView(), 'claim' => $claim,'test'=>$test));
    }

    //Affichage de mes réclamations (Client):
    public function showMyClaimsAction()
    {
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $person=$this->getUser();
        $tab=$em->getRepository(Reclamationm::class)->findMyClaims($person->getNom().' '.$person->getPrenom());
        return $this->render('@Museum/ReclamationMuseum/showMyClaims.html.twig',array('Reclamations'=>$tab));
    }

    //Aller répondre à une réclamation (Admin): //Changer l'état VU//
    public function replyClaimAction($id,Request $request){
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em=$this->getDoctrine()->getManager();
        $claim=$em->getRepository(Reclamationm::class)->find($id);
        $claim->setStatutsreclamation('Seen');
        $em->flush();
        $test="modify";
        $form=$this->createForm(ReclamationmType::class,$claim);
        $form->remove('rolesource')->remove('statutsreclamation')->remove('destinationreclamation')->remove('datereclamation');
        $form=$form->handleRequest($request);
        if($form->isValid()){
            $em->flush();
            return $this->redirectToRoute('museum_showClaimspage');
        }
        return $this->render('@Museum/ReclamationMuseum/replyClaim.html.twig',array('form'=>$form->createView(),'test'=>$test));

    }}
    //----------------------------------------------------Mobile:Reclamation(Client)------------------------------------------------------//
    //Affichage de mes réclamations (Client):
    public function showMyClaimsMobileAction($person)
    {
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        //$person=$this->getUser();
        //$username = $person->getNom().' '.$person->getPrenom();
        $tab=$em->getRepository(Reclamationm::class)->findMyClaims($person);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tab);
        return new JsonResponse($formatted);
    }
    //Envoi d'une reclamation (Client):
    public function sendClaimMobileAction(Request $request)
    {
        $claim = new Reclamationm();
        //$person=$this->getUser();
        //$username=$person->getNom()." ".$person->getPrenom();
        //$claim->setIdsource("Lakhal Fares");
        //$claim->setStatutsreclamation('Not Seen yet');
        //$mydate=getdate(date("U"));
        //$claim->setDatereclamation("$mydate[weekday] $mydate[mday] $mydate[month] $mydate[year], $mydate[hours]:$mydate[minutes]:$mydate[seconds]");
        $claim->setIdsource($request->get('idsource'));
        $claim->setRolesource($request->get('rolesource'));
        $claim->setObjetreclamation($request->get('objRec'));
        $claim->setDescriptionreclamation($request->get('descRec'));
        $claim->setDatereclamation($request->get('dateRec'));
        $claim->setStatutsreclamation($request->get('stateRec'));
        $claim->setReponsereclamation($request->get('repRec'));
        $claim->setDestinationreclamation($request->get('destRec'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($claim);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($claim);
        return new JsonResponse($formatted);
    }

    //Affichage de tous les reclamations:
    public function showClaimsMobileAction()
    {

        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $tab=$em->getRepository(Reclamationm::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tab);
        return new JsonResponse($formatted);
    }
}
