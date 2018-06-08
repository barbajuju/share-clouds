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
    public function getPictures()
    {
        $picture = $this->get('doctrine.orm.entity_manager')
            ->getRepository('App:Picture')
            ->findAll();
        /* @var $picture Picture[] */

        $formatted = [];
        foreach ($picture as $picture) {
            $formatted[] = [
                'id' => $picture->getId(),
                'title' => $picture->getTitle(),
                'image' => $picture->getImage(),
                'geolocalisation' => $picture->getGeolocalisation(),
                'comment' => $picture-> getComment(),
                'date' => $picture->getDate()
            ];
        }

        return new JsonResponse($formatted);
    }

    //Interrogation d'une photo avec son id
    /**
     * @Route("/gallerytest/{id}", name="picture_one")
     * @Method({"GET"})
     */
    public function getPicture(Request $request)
    {
        $picture = $this->get('doctrine.orm.entity_manager')
            ->getRepository('App:Picture')
            ->find($request->get('id'));
        /* @var $picture Picture */

        // Vérification de l'existance de l'id
        if (empty($picture)) {
            return new JsonResponse(['message' => 'Picture not found'], Response::HTTP_NOT_FOUND);
        }

        $formatted[] = [
            'id' => $picture->getId(),
            'title' => $picture->getTitle(),
            'image' => $picture->getImage(),
            'geolocalisation' => $picture->getGeolocalisation(),
            'comment' => $picture-> getComment(),
            'date' => $picture->getDate()
        ];

        return new JsonResponse($formatted);
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
