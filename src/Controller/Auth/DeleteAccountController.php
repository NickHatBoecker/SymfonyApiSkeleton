<?php

namespace App\Controller\Auth;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Swagger\Annotations as SWG;

class DeleteAccountController extends AbstractController
{
    /**
     * Delete account by providing password.
     *
     * @Route("/auth/delete-account/", name="delete-account", methods={"DELETE"})
     * @SWG\Response(response=200, description="Returns a success or error message")
     * @SWG\Tag(name="Authentication")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return Response
     */
    public function deleteAccountAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $parameters = json_decode($request->getContent(), false);
        $password = $parameters->password ?? null;

        if (!$password) {
            return new Response('Please provide a password', 400);
        }

        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();

        $isValid = $encoder->isPasswordValid($user, $password);
        if (!$isValid) {
            return new Response('Invalid password.', 400);
        }

        $em->remove($user);
        $em->flush();

        return new Response('Success');
    }
}
