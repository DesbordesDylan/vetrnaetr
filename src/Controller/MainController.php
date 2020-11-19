<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/accueil", name="mainpage")
     */
    public function mainPage()
    {

        $album = $this->getDoctrine()->getRepository(Album::class)->findAll();

        return $this->render('mainpage.html.twig', [
            "album" => $album
        ]);
    }

}
