<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\AddpictureType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GallerytestController extends Controller
{
    //Liste de toutes les photos
    /**
     * @Route("/gallerytest", name="gallerytest")
     * @Method({"GET"})
     */
    public function getPictures(Request $request)
    {
        $picture = $this->getDoctrine()->getRepository(Picture::class);
        $q = $request->query->get("q");
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
     * @Route("/gallerytest/{id}", name="picture_one")
     * @Method({"GET"})
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function getPicture($id, Request $request)
    {
        {
            $picture = $this->getDoctrine()->getRepository(Picture::class);
            $q = $request->query->get("q");
            $pictures = $picture->find($id);
            return $this->json(
                [
                    "status" => "ok",
                    "message" => "",
                    "data" => $pictures
                ]
            );
        }
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
