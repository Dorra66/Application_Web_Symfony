<?php

namespace MuseumBundle\Controller;

use MuseumBundle\Entity\Monument;
use MuseumBundle\Form\MonumentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MonumentController extends Controller
{
    //Ajout d'un monument (Admin):
    public function addMonumentAction(Request $request){
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $monument = new Monument();
        $test = "ajout";
        $form = $this->createForm(MonumentType::class, $monument);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monument);
            $em->flush();
            return $this->redirectToRoute('museum_showMonumentspage');
        }
        return $this->render('@Museum/Monument/addMonument.html.twig', array('form' => $form->createView(), 'test' => $test));
    }}

    //Affichage de tous les monuments (Admin):
    public function showMonumentsAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $tab=$em->getRepository(Monument::class)->findAll();
        return $this->render('@Museum/Monument/showMonuments.html.twig',array('Monument'=>$tab));
    }}

    //Modifier Monument (Admin):
    public function editMonumentAction($id,Request $request){
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em=$this->getDoctrine()->getManager();
        $monument=$em->getRepository(Monument::class)->find($id);
        $test="modify";
        $form=$this->createForm(MonumentType::class,$monument);
        $form=$form->handleRequest($request);
        if($form->isValid()){
            $em->flush();
            return $this->redirectToRoute('museum_showMonumentspage');
        }
        return $this->render('@Museum/Monument/editMonument.html.twig',array('form'=>$form->createView(),'test'=>$test));

    }}

    //Suppression d'un monument (Admin):
    public function deleteMonumentAction($id){
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em=$this->getDoctrine()->getManager();
        $monument=$em->getRepository(Monument::class)->find($id);
        $em->remove($monument);
        $em->flush();
        return $this->redirectToRoute('museum_showMonumentspage');
    }}

    //Affichage de tous les monuments (Admin):
    public function showSomeMonumentsAction()
    {
            //la création de l'entité Manager par l'appel de doctrine (notre ORM)
            $em=$this->getDoctrine()->getManager();
            //la récupération de données avec Repository
            $tab=$em->getRepository(Monument::class)->findAll();
            return $this->render('@Museum/Monument/showSomeMonuments.html.twig',array('Monument'=>$tab));
    }
    //----------------------------------------------------Mobile:Monument(Client)------------------------------------------------------//

//Affichage de tous les monuments (Client):
    public function showSomeMonumentsMobileAction()
    {
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em=$this->getDoctrine()->getManager();
        //la récupération de données avec Repository
        $tab=$em->getRepository(Monument::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tab);
        return new JsonResponse($formatted);
    }

}
