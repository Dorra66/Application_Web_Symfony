<?php

namespace ActualityBundle\Controller;

use ActualityBundle\Entity\Publicites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Publicite controller.
 *
 */
class PublicitesController extends Controller
{
    /**
     * Lists all publicite entities.
     *
     */
    public function indexAction(Request $request)
    {   $em = $this->getDoctrine()->getManager();

        $publicites = $em->getRepository('ActualityBundle:Publicites')->findAll();

            return $this->render('@Actuality/publicites/index.html.twig',array(
                'publicites' => $publicites,
            ));
        }
    public function allAction()
    {
        $publicites = $this->getDoctrine()->getManager()
            ->getRepository('ActualityBundle:Publicites')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($publicites);
        return new JsonResponse($formatted);
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $publicite = new Publicites();
        $publicite->setTitre($request->get('titre'));
        $publicite->setDescription($request->get('description'));
        $publicite->setImag($request->get('imag'));
        $em->persist($publicite);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($publicite);
        return new JsonResponse($formatted);
    }

    public function suppAction(Request $request, Publicites $publicite)
    {
        $form = $this->createDeleteForm($publicite);
        $form->handleRequest($request);


        $em = $this->getDoctrine()->getManager();
        $em->remove($publicite);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($publicite);
        return new JsonResponse($formatted);



    }



      public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publicites = $em->getRepository('ActualityBundle:Publicites')->findAll();

        return $this->render('@Actuality/publicites/home.html.twig', array(
            'publicites' => $publicites,
        ));


    }
    /////////recherche mobile/////////////////
    public function findAction($str)
    {
        $em = $this->getDoctrine()->getManager();

        $publicites = $em->getRepository('ActualityBundle:Publicites')->findEntitiesByString($str);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($publicites);
        return new JsonResponse($formatted);
    }

    /**
     * Creates a new publicite entity.
     *
     */
    public function newAction(Request $request)
    {
        $publicite = new Publicites();
        $form = $this->createForm('ActualityBundle\Form\PublicitesType', $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publicite);
            $em->flush();

            return $this->redirectToRoute('publicites_show', array('id' => $publicite->getId()));
        }

        return $this->render('@Actuality/publicites/new.html.twig', array(
            'publicite' => $publicite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publicite entity.
     *
     */
    public function showAction(Publicites $publicite)
    {
        $deleteForm = $this->createDeleteForm($publicite);

        return $this->render('@Actuality/publicites/show.html.twig', array(
            'publicite' => $publicite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publicite entity.
     *
     */
    public function editAction(Request $request, Publicites $publicite)
    {
        $deleteForm = $this->createDeleteForm($publicite);
        $editForm = $this->createForm('ActualityBundle\Form\PublicitesType', $publicite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicites_edit', array('id' => $publicite->getId()));
        }

        return $this->render('@Actuality/publicites/edit.html.twig', array(
            'publicite' => $publicite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }




    /**
     * Deletes a publicite entity.
     *
     */
    public function deleteAction(Request $request, Publicites $publicite)
    {
        $form = $this->createDeleteForm($publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publicite);
            $em->flush();
        }

        return $this->redirectToRoute('publicites_index');
    }

    /**
     * Creates a form to delete a publicite entity.
     *
     * @param Publicites $publicite The publicite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publicites $publicite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publicites_delete', array('id' => $publicite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
