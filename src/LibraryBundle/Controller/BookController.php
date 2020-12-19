<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Book controller.
 *
 */
class BookController extends Controller
{

    /**
     * Lists all book entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('LibraryBundle:Book')->findAll();
        $paginator = $this->get('knp_paginator');
        $result= $paginator->paginate( $books,
            $request->query->getInt('page',1),
            $request->query->getInt('Limit',2)
        );

        return $this->render('@Library\Book\index.html.twig', array(
            'books' => $result,
        ));
    }


    /**
     * Creates a new book entity.
     *
     */
    public function newAction(Request $request)
    {
        if(($this->container->get('security.authorization_checker')->isGranted('ROLE_CLIENT'))){
            throw new AccessDeniedException('Access Denied!!!!!');
        }
        else{
        $book = new Book();
        $form = $this->createForm('LibraryBundle\Form\BookType', $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* **************************************** IMPORTING IMAGE ******************/
            /*$file = $form['bookimage']->getData();
            $newImagename = $file->getClientOriginalName();
            $file->move($this->getParameter('book_images'),$newImagename);
            $book->setBookimage($newImagename);*/
            /****************************************************************************/

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('book_show', array('bookid' => $book->getBookid()));
        }

        return $this->render('@Library\Book\new.html.twig', array(
            'book' => $book,
            'form' => $form->createView(),
        ));
    }}

    /**
     * Finds and displays a book entity.
     *
     */
    public function showAction(Book $book)
    {
        $deleteForm = $this->createDeleteForm($book);

        return $this->render('@Library\book\show.html.twig', array(
            'book' => $book,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing book entity.
     *
     */
    public function editAction(Request $request, Book $book)
    {
        $deleteForm = $this->createDeleteForm($book);
        $editForm = $this->createForm('LibraryBundle\Form\BookType', $book);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /*$file = $editForm['bookimage']->getData();
            $newImagename = $file->getClientOriginalName();
            $file->move($this->getParameter('book_images'),$newImagename);
            $book->setBookimage($newImagename);*/

            /* ** AUTOMATIC UPDATE AFTER ADDING SOME BOOKS TO LIBRARY ** */
            if($book->getBookquantity()!=0){
                $book->setBookavail('1');
            }
           $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('book_index', array('bookid' => $book->getBookid()));
       }

        return $this->render('@Library\book\edit.html.twig', array(
            'book' => $book,
            'edit_form' => $editForm->createView(),
          'delete_form' => $deleteForm->createView(),
        ));

    }


//    public function editAction($id,Request $request){
//        $em=$this->getDoctrine()->getManager();
//        $book=$em->getRepository(Book::class)->find($id);
//        $test="modify";
//        $editForm=$this->createForm(BookType::class,$book);
//        $editForm=$editForm->handleRequest($request);
//        if($editForm->isValid()){
//            $em->flush();
//            return $this->redirectToRoute('book_show');
//        }
//        return $this->render('@Library/Book/edit.html.twig',array('form'=>$editForm->createView(),'test'=>$test));
//
//    }





    /**
     * Deletes a book entity.
     *
     */
    public function deleteAction(Request $request, Book $book)
    {
        $form = $this->createDeleteForm($book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($book);
            $em->flush();
        }

        return $this->redirectToRoute('book_index');
    }

    /**
     * Creates a form to delete a book entity.
     *
     * @param Book $book The book entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Book $book)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('book_delete', array('bookid' => $book->getBookid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function allAction(){
        $books = $this->getDoctrine()->getManager()
            ->getRepository('LibraryBundle:Book')
            ->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($books);
        return new JsonResponse($formatted);
    }



}
