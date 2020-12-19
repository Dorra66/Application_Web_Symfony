<?php

namespace ActualityBundle\Controller;

use ActualityBundle\Entity\Sponsoring;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sponsoring controller.
 *
 */
class SponsoringController extends Controller
{
    /**
     * Lists all sponsoring entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sponsorings = $em->getRepository('ActualityBundle:Sponsoring')->findAll();

        return $this->render('@Actuality/sponsoring/index.html.twig', array(
            'sponsorings' => $sponsorings,
        ));
    }
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sponsorings = $em->getRepository('ActualityBundle:Sponsoring')->findAll();

        return $this->render('@Actuality/sponsoring/home.html.twig', array(
            'sponsorings' => $sponsorings,
        ));


    }

    /**
     * Creates a new sponsoring entity.
     *
     */
    public function newAction(Request $request)
    {
        $sponsoring = new Sponsoring();
        $form = $this->createForm('ActualityBundle\Form\SponsoringType', $sponsoring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sponsoring);
            $em->flush();

            return $this->redirectToRoute('sponsoring_show', array('id' => $sponsoring->getId()));
        }

        return $this->render('@Actuality/sponsoring/new.html.twig', array(
            'sponsoring' => $sponsoring,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sponsoring entity.
     *
     */
    public function showAction(Sponsoring $sponsoring)
    {
        $deleteForm = $this->createDeleteForm($sponsoring);

        return $this->render('@Actuality/sponsoring/show.html.twig', array(
            'sponsoring' => $sponsoring,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sponsoring entity.
     *
     */
    public function editAction(Request $request, Sponsoring $sponsoring)
    {
        $deleteForm = $this->createDeleteForm($sponsoring);
        $editForm = $this->createForm('ActualityBundle\Form\SponsoringType', $sponsoring);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sponsoring_edit', array('id' => $sponsoring->getId()));
        }

        return $this->render('@Actuality/sponsoring/edit.html.twig', array(
            'sponsoring' => $sponsoring,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sponsoring entity.
     *
     */
    public function deleteAction(Request $request, Sponsoring $sponsoring)
    {
        $form = $this->createDeleteForm($sponsoring);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sponsoring);
            $em->flush();
        }

        return $this->redirectToRoute('sponsoring_index');
    }

    /**
     * Creates a form to delete a sponsoring entity.
     *
     * @param Sponsoring $sponsoring The sponsoring entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sponsoring $sponsoring)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sponsoring_delete', array('id' => $sponsoring->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
