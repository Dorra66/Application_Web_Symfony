<?php



namespace MobileBundle\Controller;

use PlanEventBundle\Entity\Avis;
use PlanEventBundle\Entity\Event;
use PlanEventBundle\Entity\Participation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;

class EventController extends Controller
{
    public function afficheEventAction()
    {
        $evenements = $this->getDoctrine()->getManager()->getRepository(Event::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($evenements);
        return new JsonResponse($formatted);
    }

    public function getDateEventAction($id)
    {
        $evenement = $this->getDoctrine()->getManager()->getRepository(Event::class)->find($id);
        $date = $evenement->getDateevent()->format('Y-m-d');
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($date);
        return new JsonResponse($formatted);
    }

    public function ajoutParticipAction($idevent, $iduser)
    {

        $participation = new Participation();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($idevent);
        $user = $em->getRepository(User::class)->find($iduser);
        $participation->setIduser($user);
        $participation->setIdevent($event);
        $tab = $em->getRepository(Participation::class)->findParticiaptionsEvent($event->getIdevent(), $user->getId());
        if (empty($tab)) {
            $event->setNbrplacedispo(($event->getNbrplacedispo()) - 1);
            $em->persist($participation);
            $em->flush();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($participation);
        return new JsonResponse($formatted);


    }

    public function MyParticipationsAction($id)
    {
        $test = "current";
        $em = $this->getDoctrine();
        $tab = $em->getRepository(Participation::class)->findMyParticiaptions($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tab);
        return new JsonResponse($formatted);
    }

    public function UserDeletePartAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository(Event::class)->find($request->get('idevent'));
        $evenement->setNbrplacedispo(($evenement->getNbrplacedispo()) + 1);
        $user = $em->getRepository(User::class)->find($request->get('id'));
        $participation = $em->getRepository(Participation::class)->findOneBy(array("idevent"=>$evenement,"iduser"=>$user));
        $em->remove($participation);
        $em->flush();

        //$serializer = new Serializer([new ObjectNormalizer()]);
        //$formatted = $serializer->normalize($avisEvenement);
        return new JsonResponse();


    }

    public function getMyPartAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository(Event::class)->find($request->get('idevent'));
        $user = $em->getRepository(User::class)->find($request->get('id'));
        $participation= $em->getRepository(Participation::class)->findOneBy(array("Evenement"=>$evenement,"User"=>$user));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($participation);
        return new JsonResponse($formatted);
    }


    public function ajouterAvisEvenementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository(Event::class)->find($request->get('idevent'));
        $user = $em->getRepository(User::class)->find($request->get('iduser'));
        $avisEvenement = $em->getRepository(Avis::class)->findOneBy(array("idevent"=>$evenement,"iduser"=>$user));
        if($avisEvenement==null) {
            $avisEvenement = new Avis();
            //$valeur = $request->get('description');
            $commentaire = $request->get('commentaire');
            $avisEvenement->setIdevent($evenement);
            $avisEvenement->setIduser($user);
            //$avisEvenement->setValeur($valeur);
            $avisEvenement->setDescriptionavis($commentaire);
            $em->persist($avisEvenement);
            $em->flush();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($avisEvenement);
        return new JsonResponse($formatted);
    }


    public function MyFeedBacksAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // $user = $em->getRepository(User::class)->find($request->get('iduser'));
        $tab = $em->getRepository(Avis::class)->MyFeed($request->get('iduser'));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tab);
        return new JsonResponse($formatted);
    }



}

