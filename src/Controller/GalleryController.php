<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Picture;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GalleryController extends Controller
{
    //Interrogation d'une photo avec son id
    /**
     * @Route("/gallery/connex", name="picture_one")
     * @Method({"GET"})
     */
    public function getPicture(Request $request)
    {

        $id = $request->request->get('id');

        $pictureList = $this->getDoctrine()->getRepository(Users::class);
        $picture = $pictureList->findOneByNickname($id);

        return $this->json(
            [
                "status" => "ok",
                "message" => "connexion réussie mon capitaine !",
                "data" => $picture
            ]);
    }

}