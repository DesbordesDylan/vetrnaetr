<?php

namespace App\Controller;

use DateTime;
use App\Entity\Song;
use App\Entity\Album;
use App\Entity\Artist;
use App\Form\Type\SongType;
use App\Form\Type\AlbumType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/song")
 */
class SongController extends AbstractController
{
    

/**
 * @Route("/{id}/create", name="song_create")
 */
public function createSong(Request $request, Album $album) {

    $newSong = new Song();

    $newSong->setAlbum($album);

    $form = $this->createForm(SongType::class, $newSong);
    $form->handleRequest($request);
    if ($form->isSubmitted()&& $form->isValid()) {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($newSong);
        $manager->flush();

        $this->addFlash("success", "La musique a bien été ajoutée");
            return $this->redirectToRoute('mainpage');
    }

    return $this->render(
        "song/create.html.twig",
        [
            "formView" => $form->createView()
        ]
    );
}

/**
     * @Route("/delete/{id}", name="song_delete")
     */
    public function songDelete(Song $song) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($song);
        $entityManager->flush();

        $this->addFlash("warning", "Le son a bien été supprimé !");

        return $this->redirectToRoute("home");

    }

}