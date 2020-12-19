<?php

namespace ActualityBundle\Controller;
use ActualityBundle\Repository\PublicitesRepository;
use ActualityBundle\Entity\Publicites;
use ActualityBundle\Form\PublicitesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller

{

    public function tohomeAction()
    {

        $u=$this->container->get('security.token_storage')->getToken()->getUser();
        switch ($u->getRoles()[0]){
            case "ROLE_ADMIN":return $this->redirect('main_adminpage');break;
            case "ROLE_CLIENT":return $this->redirect('main_userpage');break;
        }
        die();

    }
    public function userAction()
    {
        return $this->render('@Actuality/Client/user.html.twig');


    }
    public function adminAction()
    {

        return $this->render('@Actuality/Admin/admin.html.twig');

    }
    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getTitre();
        }
        return $realEntities;
    }
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities =  $em->getRepository(Publicites::class)->findEntitiesByString($requestString);
        if(!$entities) {
            $result['entities']['error'] = "aucun resultat trouvé";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));
    }

    public function affsearchAction()
    {
        return $this->render('@Actuality/search.html.twig');


    }






}
