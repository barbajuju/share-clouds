<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TakePictureController extends Controller
{
    /**
     * @Route("/picture", name="picture")
     */
    public function index()
    {
        return $this->render('take_picture/index.html.twig', [
            'controller_name' => 'TakePictureController',
        ]);
    }
}
