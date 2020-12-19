<?php

namespace MuseumBundle\Controller;

use MuseumBundle\Entity\Monument;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use MuseumBundle\Entity\Entity;
use MuseumBundle\Repository\MonumentRepository;

class DefaultController extends Controller
{
    public function adminHomeAction()
    {
        if (($this->container->get('security.authorization_checker')->isGranted('ROLE_AGENT'))){
            return $this->render('@Museum/Default/adminHome.html.twig');}
    }

    public function userHomeAction()
    {
        if (($this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))){
            return $this->render('@Museum/Default/userHome.html.twig');}
    }

    public function indexAction()
    {
        return $this->render('MuseumBundle:Default:index.html.twig');
    }

    /**
     * Creates a new ActionItem entity.
     *
     * @Route("/search", name="ajax_search")
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities =  $em->getRepository(Monument::class)->findEntitiesByString($requestString);
        if(!$entities) {
            $result['entities']['error'] = "keine Einträge gefunden";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getFoo();
        }
        return $realEntities;
    }
}
