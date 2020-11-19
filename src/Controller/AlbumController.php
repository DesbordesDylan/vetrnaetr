<?php

namespace App\Controller;

use DateTime;
use App\Entity\Album;
use App\Entity\Artist;
use App\Form\Type\AlbumType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class AlbumController extends AbstractController
{
    
    /**
     * @Route("/album/list", name="album_list")
     */
    public function albumList()
    {   
        $album = $this->getDoctrine()->getRepository(Album::class)->findAll();

        return $this->render('mainpage.html.twig', [
            "album" => $album
        ]);
    }

    /**
     * @Route("/album/create", name="album_create")
     */
    public function albumCreate(Request $request, SluggerInterface $slugger) {

        $album = new Album();

        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();

            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('kernel.project_dir').'/public/assets/images',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $album->setBrochure($newFilename);
            }

            // ... persist the $product variable or any other work
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($album);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('album/create.html.twig', [
            'form' => $form->createView(),
            'album' => $album
        ]);
    }

    /**
     * @Route("/album/{id}/update", name="album_update")
     */
    public function albumUpdate(Request $request, SluggerInterface $slugger, Album $album) {

        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brochureFile = $form->get('brochure')->getData();

            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('kernel.project_dir').'/public/assets/images',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $album->setBrochure($newFilename);
            }
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($album);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('album/create.html.twig', [
            'form' => $form->createView(),
            'album' => $album
        ]);
    }

    /**
     * @Route("/album/{id}", name="album_view")
     */
    public function albumView(Album $album)
    {   

        return $this->render('album/view.html.twig', [
            "album" => $album
        ]);
    }

    /**
     * @Route("album/delete/{id}", name="album_delete")
     */
    public function albumDelete(Album $album) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($album);
        $entityManager->flush();

        $this->addFlash("warning", "L'album a bien été supprimé !");

        return $this->redirectToRoute("home");

    }

}