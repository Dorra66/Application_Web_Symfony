<?php

namespace MuseumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserController extends Controller
{
    public function loginAction(Request $request){
        $user_manager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');
        $user = $user_manager->findUserByUsername($request->get('username'));
        $serializer = new Serializer([new ObjectNormalizer()]);
        if ($user) {
            $encoder = $factory->getEncoder($user);
            if ($encoder->isPasswordValid($user->getPassword(), $request->get('password'), $user->getSalt())) {
                $formatted = $serializer->normalize($user);
            } else {
                $formatted = $serializer->normalize(null);
            }
        } else {
            $formatted = $serializer->normalize(null);
        }
        return new JsonResponse($formatted);
    }
}
