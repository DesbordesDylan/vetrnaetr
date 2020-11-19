<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController {
    
    /**
     *@Route("/contact", name="contact")
     */
    public function show(Request $request, ContactNotification $notification) {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre email a bien été envoyé !');
            return $this->redirectToRoute('home');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}