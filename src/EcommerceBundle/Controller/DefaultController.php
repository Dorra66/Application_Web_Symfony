<?php

namespace EcommerceBundle\Controller;

use MainBundle\Entity\AnnonceProd;

use MainBundle\Entity\Commande;
use MainBundle\Form\AnnonceProdType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Ecommerce/Default/index.html.twig');
    }

    public function choixAction()
    {
        return $this->render('@Ecommerce/Default/choix.html.twig');
    }

    public function listproduitsAction()
    {
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em = $this->getDoctrine();
        //la récupération de données avec Repository
        $tab= $em->getRepository(AnnonceProd::class)->findAll();

        return $this->render('@Ecommerce/Default/listproduits.html.twig', array('tabs' => $tab));
    }
    public function deleteprodAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $AnnonceProd=$em->getRepository(AnnonceProd::class)->find($id);
        $em->remove($AnnonceProd);
        $em->flush();
        return $this->redirectToRoute('ecommerce_listpage');
    }
    public function ajoutprodAction(Request $request)
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $AnnonceProd=new AnnonceProd();
        $test="add";
        $form=$this->createForm(AnnonceProdType::class,$AnnonceProd);
        $form=$form->handleRequest($request);
        if ($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($AnnonceProd);
            $em->flush();
            return $this->redirectToRoute('ecommerce_listpage');



        }
        return $this->render('@Ecommerce/Default/ajoutprod.html.twig',
            array('form'=>$form->createView(),'test'=>$test));
    }}

    public function updateprodAction($id, Request $request)
    {
        //1 récupération de l'objet
        $em=$this->getDoctrine()->getManager();
        $AnnonceProd=$em->getRepository(AnnonceProd::class)->find($id);
        //2 préparation du formulaire
        $test="modify";
        $form=$this->createForm(AnnonceProdType::class,$AnnonceProd);
        //3 Récupération des données
        $form=$form->handleRequest($request);
        //4 Sauvegarde des données
        if ($form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('ecommerce_listpage');
        }
        return $this->render('@Ecommerce/Default/ajoutprod.html.twig',
            array('form'=>$form->createView(),'test'=>$test));

    }
    public function adminAction()
    {
        if (($this->container->get('security.authorization_checker')->isGranted('ROLE_AGENT'))){
            return $this->render('@Ecommerce/Default/admin.html.twig');}
    }
    public function userAction()
    {
        if (($this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))){
            return $this->render('@Ecommerce/Default/user.html.twig');}
    }

    public function chartAction()
    {
        return $this->render('@Ecommerce/Default/chart.html.twig');
    }
    public function listcmdAction()
    {
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em = $this->getDoctrine();
        //la récupération de données avec Repository
        $tab = $em->getRepository(Commande::class)->findAll();
        return $this->render('@Ecommerce/Default/cmd.html.twig', array('cmds' => $tab));
    }
}