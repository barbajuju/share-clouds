<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Users;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {

        // Création d'un nouvel utilisateur :
        $gege = new Users();
        $gege->setFirstname('gérard');
        $gege->setName('bouchard');
        $gege->setMail('mail');
        $gege->setPseudo('gégé');
        $gege->setPassword('motdepassegégé');

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($gege);

        // Étape 2 : On « flush » tout ce qui a été persisté avant
        $em->flush();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }





}
