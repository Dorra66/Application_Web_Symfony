<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Book;
use LibraryBundle\Entity\Issue;
use LibraryBundle\Entity\Userrequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Issue controller.
 *
 */
class IssueController extends Controller
{
    /**
     * Lists all Issue entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('LibraryBundle:Issue')->findAll();

        return $this->render('@Library\Issue\index.html.twig', array(
            'issues' => $issues,
        ));
    }

    /**
     * Creates a new Issue entity.
     *
     */
    public function newAction(Request $request)
    {
        $issue = new Issue();
        $form = $this->createForm('LibraryBundle\Form\IssueType', $issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($issue);
            $em->flush();

            return $this->redirectToRoute('issue_show', array('issueid' => $issue->getIssueid()));
        }

        return $this->render('@Library\Issue\new.html.twig', array(
            'Issue' => $issue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Issue entity.
     *
     */
    public function showAction(Issue $issue)
    {
        $deleteForm = $this->createDeleteForm($issue);

        return $this->render('@Library\Issue\show.html.twig', array(
            'Issue' => $issue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Issue entity.
     *
     */
    public function editAction(Request $request, Issue $issue)
    {
        $deleteForm = $this->createDeleteForm($issue);
        $editForm = $this->createForm('LibraryBundle\Form\IssueType', $issue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('issue_index', array('issueid' => $issue->getIssueid()));
        }

        return $this->render('@Library\Issue\edit.html.twig', array(
            'Issue' => $issue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Issue entity.
     *
     */
    public function deleteAction(Request $request, Issue $issue)
    {
        $form = $this->createDeleteForm($issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($issue);
            $em->flush();
        }

        return $this->redirectToRoute('issue_index');
    }

    /**
     * Creates a form to delete a Issue entity.
     *
     * @param Issue $issue The Issue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Issue $issue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('issue_delete', array('issueid' => $issue->getIssueid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Creates a new userrequest entity.
     *s
     */
    public function returnAction($issueid)
    {

        $em = $this->getDoctrine()->getManager();
        $issue= $em->getRepository(Issue::class)->find($issueid);
        $em->getRepository(Issue::class)->incrementStock($issue->getBooktitle());
        $em->getRepository(Issue::class)->updateAvailTrue($issue->getBooktitle());
        $em->remove($issue);
        $em->flush();
        return $this->redirectToRoute('issue_index', array('issueid' => $issueid));
    }
}
