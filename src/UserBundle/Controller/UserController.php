<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;

class UserController extends Controller
{

    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();

        /* ***************   add Paginator   ****************** */
        $paginator = $this->get('knp_paginator');
        $result= $paginator->paginate( $users,
            $request->query->getInt('page',1),
            $request->query->getInt('Limit',5)
        );
        /* ***************************************************  */
        return $this->render('@User/User/index.html.twig', array(
            'users' => $result,
        ));
    }

    public function AllUserAction(Request $request){
        $users = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:User')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($users);
        return new JsonResponse($formatted);
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository(User::class)->find($id);
        $em->remove($user);
        $em->flush();
        var_dump($id);
        return $this->redirectToRoute('user_index');
    }
}
