<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class TestController extends AbstractController
{
    /**
     * Just a test to test secure action.
     *
     * @Route("/test/", name="test", methods={"GET"})
     * @SWG\Response(response=200, description="Returns a simple hello world")
     * @SWG\Tag(name="Other")
     */
    public function index()
    {
        return new Response('Hello world');
    }
}
