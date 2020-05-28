<?php

namespace App\Controller\Auth;

use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class LoginController
{
    /**
     * Login and retrieve JWT Token.
     *
     * @Route("/auth/login/", name="login", methods={"POST"})
     * @SWG\Response(response=200, description="Returns the user's JWT token")
     * @SWG\Tag(name="Authentication")
     */
    public function loginAction()
    {
        // The security layer will intercept this request
    }
}
