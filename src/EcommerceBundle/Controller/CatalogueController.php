<?php

namespace EcommerceBundle\Controller;

use MainBundle\Entity\Commande;
use MainBundle\Entity\Panier;
use MainBundle\Form\PanierType;
use MainBundle\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Form\AnnonceProdType;
use MainBundle\Entity\AnnonceProd;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;



class CatalogueController extends Controller
{
    public function catalogueproduitsAction()
    {
        //la création de l'entité Manager par l'appel de doctrine (notre ORM)
        $em = $this->getDoctrine();
        //la récupération de données avec Repository
        $tab = $em->getRepository(AnnonceProd::class)->findAll();
        return $this->render('@Ecommerce/Catalogue/Catalogueproduits.html.twig', array('prods' => $tab));
    }

    public function addproduitsAction($id)

    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(AnnonceProd::class)->find($id);
        $user = $em->getRepository(User::class)->find($this->getUser()->getId());
        $panier = new Panier();
        $panier->setUser($user);
        $panier->setProduit($produit);
        $em->persist($panier);
        $em->flush();
        return $this->redirectToRoute('ecommerce_affichecataloguepage');
    }


    public function showpanierAction()
    {
        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT p 
            FROM MainBundle:Panier p  where p.user='$user'
                        ");
        $tab = $query->getResult();

        return $this->render('@Ecommerce/Catalogue/monpanier.html.twig', array('paniers' => $tab));
    }

    public function gettotalAction()
    {
        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT  SUM(a.prix)
            FROM MainBundle:Panier p LEFT JOIN MainBundle:AnnonceProd a where p.user='$user' AND p.produit=a.idProd
                        ");
        $total = $query->getSingleScalarResult();
        return $this->render('@Ecommerce/Catalogue/total.html.twig', array('total' => $total));
    }

    public function validecmdAction()
    {

        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT  SUM(a.prix)
            FROM MainBundle:Panier p LEFT JOIN MainBundle:AnnonceProd a where p.user='$user' AND p.produit=a.idProd
                        ");
        $total = $query->getSingleScalarResult();
        $commande = new Commande();
        $commande->setIdClient($user);
        $commande->setDate(new \DateTime('now'));
        $commande->setTotal($total);
        $em->persist($commande);
        $panier=$em->getRepository(Panier::class)->findBy(array('user'=>$user));
        foreach ($panier as $pan) {
            $em->remove($pan);}
          $em->flush();

        $query1 = $em->createQuery("UPDATE MainBundle:AnnonceProd a SET a.stock=a.stock-1 
             where a.idProd='29'
                        ");
                            $tab = $query1->getResult();
        $query2 = $em->createQuery("UPDATE MainBundle:AnnonceProd a SET a.stock=a.stock-1 
             where a.idProd='28'
                        ");
        $tab = $query2->getResult();
        $query3 = $em->createQuery("UPDATE MainBundle:AnnonceProd a SET a.stock=a.stock-1 
             where a.idProd='27'
                        ");
        $tab = $query3->getResult();
        $query4 = $em->createQuery("UPDATE MainBundle:AnnonceProd a SET a.stock=a.stock-1 
             where a.idProd='21'
                        ");
        $tab = $query4->getResult();
        $query5 = $em->createQuery("UPDATE MainBundle:AnnonceProd a SET a.stock=a.stock-1 
             where a.idProd='22'
                        ");
        $tab = $query5->getResult();
        $query6 = $em->createQuery("UPDATE MainBundle:AnnonceProd a SET a.stock=a.stock-1 
             where a.idProd='20'
                        ");
        $tab = $query6->getResult();
        $query7 = $em->createQuery("UPDATE MainBundle:AnnonceProd a SET a.stock=a.stock-1 
             where a.idProd='19'
                        ");
        $tab = $query7->getResult();
            return $this->render('@Ecommerce/Catalogue/commande.html.twig');

        }





    public function cancelcmdAction(){
        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $panier=$em->getRepository(Panier::class)->findBy(array('user'=>$user));
        foreach ($panier as $pan) {
            $em->remove($pan);}
        $em->flush();
        return $this->redirectToRoute('ecommerce_affichecataloguepage');
    }
    public function allAction()
    {
        $tabs = $this->getDoctrine()->getManager()->getRepository(AnnonceProd::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tabs);
        return new JsonResponse($formatted);
    }
    public function allUsersAction()
    {
        $tabs = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tabs);
        return new JsonResponse($formatted);
    }

    public function allpanierAction()
    {
        $tabs = $this->getDoctrine()->getManager()->getRepository(Panier::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tabs);
        return new JsonResponse($formatted);
    }
    public function gettotalperAction()
    { $user=5;
        //$user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT  SUM(a.prix)
            FROM MainBundle:Panier p LEFT JOIN MainBundle:AnnonceProd a where p.user='$user' AND p.produit=a.idProd
                        ");
        $total = $query->getSingleScalarResult();
        // return $this->render('@Ecommerce/Catalogue/total.html.twig', array('total' => $total));
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($total);
        return new JsonResponse($formatted);
    }
    public function showpanierperAction()
    {     $user=5;
        //$user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT p 
            FROM MainBundle:Panier p  where p.user='$user'
                        ");
        $tab = $query->getResult();

        //return $this->render('@Ecommerce/Catalogue/monpanier.html.twig', array('paniers' => $tab));
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($tab);
        return new JsonResponse($formatted);
    }
    public function addproduitsperAction($id)

    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(AnnonceProd::class)->find($id);
        $user = $em->getRepository(User::class)->find(5);

        $panier = new Panier();
        $panier->setUser($user);
        $panier->setProduit($produit);
        $em->persist($panier);
        $em->flush();
        //return $this->redirectToRoute('ecommerce_affichecataloguepage');
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formatted= $serializer->normalize($panier);
        return new JsonResponse($formatted);
    }









}