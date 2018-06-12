<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\AddpictureType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class APIShareClouds extends Controller
{
    //Liste de toutes les photos
    /**
     * @Route("/picture", name="gallerytest")
     * @Method({"GET"})
     */
    public function getPictureList(Request $request)
    {
        $picture = $this->getDoctrine()->getRepository(Picture::class);
        $pictures = $picture->findAll();
        return $this->json(
            [
                "status" => "ok",
                "message" => "",
                "data" => $pictures
            ]
        );
    }

    //Interrogation d'une photo avec son id
    /**
     * @Route("/picture/{id}", name="api_movies_detail", methods={"GET"})
     */
    public function getPictureDetails(int $id, Request $request)
    {
        $picture = $this->getDoctrine()->getRepository(Picture::class);
        $pictures = $picture->find($id);

        return $this->json(
            [
                "status" => "ok",
                "message" => "",
                "data" => $pictures
            ]
        );
    }


    //Ajout d'une image
    /*          //manque une étoile
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/gallerytest")
     */
    public function postPicture(Request $request)
    {
        $picture = new Picture();
        $form = $this->createForm(AddpictureType::class, $picture);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($picture);
            $em->flush();
            return $picture;
        } else {
            return $form;
        }
    }

}
