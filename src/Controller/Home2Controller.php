<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Home2Controller extends Controller
{
    /**
     * @Route("/home2/", name="home2")
     */
    public function index()
    {
        return $this->render('home2/index.html.twig', [
            'controller_name' => 'Home2Controller',
        ]);
    }
}
