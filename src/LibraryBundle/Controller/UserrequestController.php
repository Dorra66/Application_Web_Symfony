<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Book;
use LibraryBundle\Entity\Issue;
use LibraryBundle\Entity\Userrequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



/**
 * Userrequest controller.
 *
 */
class UserrequestController extends Controller
{
    /**
     * Lists all userrequest entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userrequests = $em->getRepository(Userrequest::class)->findAll();
        return $this->render('@Library\Userrequest\index.html.twig', array(
            'userrequests' => $userrequests,
        ));
    }

    public function userIndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userrequests = $em->getRepository(Userrequest::class)->findEmail($this->getUser()->getEmail());

        return $this->render('@Library\Userrequest\userindex.html.twig', array(
            'userrequests' => $userrequests,
        ));
    }

    /**
     * Creates a new userrequest entity.
     *
     */
    public function newAction(Request $request,$id)
    {
        $userrequest = new Userrequest();
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository(Book::class)->find($id);

        $userrequest->setBookid($book->getBookId());
        $userrequest->setMemberid($this->getUser()->getId());
        $userrequest->setBooktitle($book->getBooktitle());
        $userrequest->setMembername($this->getUser()->getUsername());
        $userrequest->setMemberlastname($this->getUser()->getPrenom());
        $userrequest->setMemberemail($this->getUser()->getEmail());


        $form = $this->createForm('LibraryBundle\Form\UserrequestType', $userrequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($userrequest);
            $em->flush();
            return $this->redirectToRoute('library_homepage', array('idrequest' => $userrequest->getIdrequest()));
        }

        return $this->render('@Library\Userrequest\new.html.twig', array(
            'userrequest' => $userrequest,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userrequest entity.
     *
     */
    public function showAction(Userrequest $userrequest)
    {
        $deleteForm = $this->createDeleteForm($userrequest);

        return $this->render('@Library\Userrequest\show.html.twig', array(
            'userrequest' => $userrequest,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing userrequest entity.
     *
     */
    public function editAction(Request $request, Userrequest $userrequest)
    {
        $deleteForm = $this->createDeleteForm($userrequest);
        $editForm = $this->createForm('LibraryBundle\Form\UserrequestType', $userrequest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('library_AdminUserRequestIndex', array('idrequest' => $userrequest->getIdrequest()));
        }

        return $this->render('userrequest/edit.html.twig', array(
            'userrequest' => $userrequest,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userrequest entity.
     *
     */
    public function deleteAction(Request $request, Userrequest $userrequest)
    {
        $form = $this->createDeleteForm($userrequest);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $book= $em->getRepository(Book::class)->find($userrequest->getBookid());
            $userFromRequest=$em->getRepository(Userrequest::class)->find($userrequest->getIdrequest());
            $user=$em->getRepository(User::class)->find($userrequest->getMemberid());

            if ($book->getBookquantity()!=0){
                //Add Issue :
                $issue = new Issue();
                $issue->setBookid($book);
                $issue->setMemberid($user);
                $issue->setBooktitle($book->getBooktitle());
                $issue->setMembername($userFromRequest->getMembername());
                $issue->setMemberlastname($userFromRequest->getMemberlastname());
                $issue->setMembermobile($userFromRequest->getMembermobile());
                $issue->setIssuetime($userFromRequest->getIssuedate());
                $em = $this->getDoctrine()->getManager();
                $em->persist($issue);
                $em->flush();
                //Decrement Book Stock
                $em->getRepository(Issue::class)->issue($userrequest->getBookid());
                //Update User Request State
                $em->getRepository(Userrequest::class)->updateState($userrequest->getIdrequest());
                if($book->getBookquantity()==1){
                //Update Book Avail
                    $em->getRepository(Issue::class)->updateAvail($userrequest->getBookid());
                }
            }
            else
                return $this->redirectToRoute('library_AdminUserRequestIndex', array('idrequest' => $userrequest->getIdrequest()));
            //Delete Request
            $em = $this->getDoctrine()->getManager();
            $em->remove($userrequest);
            $em->flush();
        }
        return $this->redirectToRoute('library_AdminUserRequestIndex');

    }
    /**
     * Creates a form to delete a userrequest entity.
     *
     * @param Userrequest $userrequest The userrequest entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Userrequest $userrequest)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('library_ADMINuserrequestdelete', array('idrequest' => $userrequest->getIdrequest())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function newUserRequestMobileAction(Request $request)
    {


        $userrequest = new Userrequest();
        $book = new Book();


        $em = $this->getDoctrine()->getManager();
        $books=$em->getRepository(Book::class)->findAll();
        foreach ($books as $book){
            $book =$em->getRepository(Book::class)->findBy(array('booktitle' => $request->get('booktitle')));

        }
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository(Book::class)->find($book[0]->getBookid());
        $user=$em->getRepository(User::class)->find($memberid=  (int)($request->get('memberid')));

        $userrequest-> setMemberid($user);
        $userrequest-> setBookid($book);
        $userrequest-> setBooktitle($request->get('booktitle'));
        $userrequest-> setMembername($request->get('membername'));
        $userrequest-> setMemberlastname($request->get('memberlastname'));
        $userrequest-> setMemberemail($request->get('memberemail'));
        $userrequest-> setMembermobile($request->get('membermobile'));
        $string =$request->get('issuedate');
        $date = \DateTime::createFromFormat('d-m-Y', $string);
        $userrequest-> setIssuedate($date);
        $userrequest-> setIssueperiod($request->get('issueperiod'));
        $user= $em->getRepository(User::class)->find($memberid);
        $userrequest->setWeakmemberid($user->getId());

        $em->persist($userrequest);
        $em->flush();

        $serializer = new Serializer(array(new DateTimeNormalizer('d-m-Y')));
        $dateAsString = $serializer->normalize($date);
        $userrequest-> setIssuedate($dateAsString);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($userrequest);
        return new JsonResponse($formatted);

        /* *************************    ADD DATE     ****************************** */
        // $bf = substr($string, 0, 24);
        //$af = substr($string, 25, 35);
        //$mystring = $bf.'+'.$af;
        // $date = \DateTime::createFromFormat('EEE MMM dd HH:mm:ss z yyyy', 'Tue Dec 24 16:27:21 GMT+01:00 2019');
        // $date = \DateTime::createFromFormat('D M d H:i:s T Y', $mystring);
        // $serializer = new Serializer(array(new DateTimeNormalizer('D M d H:i:s T Y')));
    }

    public function allAction(){
        $userrequest = new Userrequest();
        $userrequests = $this->getDoctrine()->getManager()
            ->getRepository('LibraryBundle:Userrequest')
            ->findAll();
        foreach ($userrequests as $userrequest) {
            $serializer = new Serializer(array(new DateTimeNormalizer('d-m-Y')));
            $dateAsString = $serializer->normalize( $userrequest->getIssuedate());
            $userrequest-> setIssuedate($dateAsString);
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($userrequests);
        return new JsonResponse($formatted);
    }

    public function deleteUserRequestAction(Request $request)
    {
        $requestid= $request->get('idrequest');

        $em = $this->getDoctrine()->getManager();
        $request = $em->getRepository(Userrequest::class)->find($requestid);
        $em->remove($request);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($request);
        return new JsonResponse($formatted);
    }






}
