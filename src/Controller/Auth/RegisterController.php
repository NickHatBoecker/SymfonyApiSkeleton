<?php

namespace App\Controller\Auth;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class RegisterController extends AbstractController
{
    /**
     * Register via username and password.
     *
     * @Route("/auth/register/", name="register", methods={"POST"})
     * @SWG\Response(response=200, description="Returns a success or error message")
     * @SWG\Tag(name="Authentication")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $parameters = json_decode($request->getContent(), false);
        $username = $parameters->username ?? null;
        $password = $parameters->password ?? null;

        if (!$username || !$password) {
            return new Response('Please provide a username and a password', 400);
        }

        $em = $this->getDoctrine()->getManager();

        if ($em->getRepository(User::class)->findByUsername($username)) {
            return new Response('A user with this username already exists', 400);
        }

        $user = (new User())->setUsername($username);
        $user->setPassword($encoder->encodePassword($user, $password));

        $em->persist($user);
        $em->flush();

        return new Response('Success');
    }
}
