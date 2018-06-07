<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\AddpictureType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\ProductType;
use App\Service\FileUploader;

class TakePictureAPIController extends Controller
{
    /**
     * @Route("/pictureapi", name="take_picture_api")
     */
    public function index(Request $request, FileUploader $fileUploader)
    {

        $picture=new Picture();
        $form = $this->createForm(AddpictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $picture->getImage();
            $fileName = $fileUploader->upload($file);
            $picture->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($picture);
            $em->flush();
            /* return $this->redirectToRoute("home"); */

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('take_picture_api/index.html.twig', [
            'controller_name' => 'TakePictureAPIController',
            "form" => $form->createView(),
        ]);
    }
}
