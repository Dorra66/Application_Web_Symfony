<?php

namespace ActualityBundle\Controller;

use ActualityBundle\Entity\Actualites;
use ActualityBundle\Entity\Asign;
use ActualityBundle\Entity\Favoirs;
use ActualityBundle\Form\AsignType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Entity\User;

/**
 * Actualite controller.
 *
 */
class ActualitesController extends Controller
{
    /**
     * Lists all actualite entities.
     *
     */
    public function indexAction()
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('ActualityBundle:Actualites')->findAll();

        return $this->render('@Actuality/actualites/index.html.twig', array(
            'actualites' => $actualites,
        ));
    }}
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('ActualityBundle:Actualites')->myfindAll('1');

        return $this->render('@Actuality/actualites/home.html.twig', array(
            'actualites' => $actualites,
        ));


    }
    public function afficheAction(Actualites $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);

        return $this->render('@Actuality/actualites/affiche.html.twig', array(
            'actualite' => $actualite,
            'delete_form' => $deleteForm->createView(),
        ));


    }
    public function favAction($id)
    {
        $fav=new Favoirs();
        $em=$this->getDoctrine()->getManager();
        $actualite=$em->getRepository(Actualites::class)->find($id);
        $u=$this->getUser();
        $user=$em->getRepository(User::class)->find($u);
        $fav->setUser($user);
        $fav->setActualite($actualite);

        $em->persist($fav);
        $em->flush();
        $ou = $em->getRepository('ActualityBundle:Favoirs')->finduser($u->getId());
        return $this->render('@Actuality/actualites/fav.html.twig', array('ou' => $ou));


    }
    /////////////////////////////
    public function dfavAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $variable = $em->getRepository(Favoirs::class)->find($id);
        $em->remove($variable);
        $em->flush();
        return $this->redirectToRoute('actualites_showfav');


    }
    public function favshowAction()
    {
        $em = $this->getDoctrine()->getManager();
        $u=$this->getUser();

        $fav = $em->getRepository('ActualityBundle:Favoirs')->finduser($u->getId());

        return $this->render('@Actuality/actualites/favshow.html.twig', array(
            'fav' => $fav));


    }

    public function signalAction($id)
    {
        $em = $this->getDoctrine();
        $actualite = $em->getRepository('ActualityBundle:Actualites')->find($id);
        $actualite->setState('0');
        //$em->getManager()->persist($actualite);
        $asign=new Asign();
        $asign->setActualite($actualite);
        $m=$em->getManager();
        $m->persist($actualite);
        $m->persist($asign);
        $m->flush();
        return $this->redirectToRoute('actualites_home');

    }
    public function signalshowAction()
    {
        $em = $this->getDoctrine()->getManager();

        $asign = $em->getRepository('ActualityBundle:Asign')->findAll();

        return $this->render('@Actuality/actualites/signalshow.html.twig', array(
            'asign' => $asign,
        ));
    }
    //////////////////////
    public function signaldeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $variable = $em->getRepository(Asign::class)->find($id);
        $em->remove($variable);
        $em->flush();
        return $this->redirectToRoute('actualites_signalshow');

    }

    /**
     * Creates a new actualite entity.
     *
     */
    public function newAction(Request $request)
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $actualite = new Actualites();
        $form = $this->createForm('ActualityBundle\Form\ActualitesType', $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('actualites_show', array('id' => $actualite->getId()));
        }

        return $this->render('@Actuality/actualites/new.html.twig', array(
            'actualite' => $actualite,
            'form' => $form->createView(),
        ));
    }}

    /**
     * Finds and displays a actualite entity.
     *
     */
    public function showAction(Actualites $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);

        return $this->render('@Actuality/actualites/show.html.twig', array(
            'actualite' => $actualite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing actualite entity.
     *
     */
    public function editAction(Request $request, Actualites $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);
        $editForm = $this->createForm('ActualityBundle\Form\ActualitesType', $actualite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actualites_edit', array('id' => $actualite->getId()));
        }

        return $this->render('@Actuality/actualites/edit.html.twig', array(
            'actualite' => $actualite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a actualite entity.
     *
     */
    public function deleteAction(Request $request, Actualites $actualite)
    {
        $form = $this->createDeleteForm($actualite);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actualite);



            $em->flush();
        }

        return $this->redirectToRoute('actualites_index');
    }


    /**
     * Creates a form to delete a actualite entity.
     *
     *
     * @param Actualites $actualite The actualite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Actualites $actualite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actualites_delete', array('id' => $actualite->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /*public function deleteeeAction($id){
        $em = $this->getDoctrine()->getManager();
        $act=$em->getRepository(Actualites::class)->find($id);



    }*/
}
