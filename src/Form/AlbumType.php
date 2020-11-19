<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class AlbumType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {   

        $builder->add(
            'artist',
            TextType::class,
            [
                "label" => "Artiste de l'album"
            ]
        );

        $builder->add(
            'title',
            TextType::class,
            [
                "label" => "Titre de l'album"
            ]
        );

        $builder->add(
            'description',
            TextType::class
        );

        $builder->add(
            'listeningTime',
            TextType::class,
            [
                "label" => "Temps d'écoute",
            ]
        );

        $builder->add('brochure', FileType::class, [
            'label' => 'Image',
            'mapped' => false,
            'required' => false

        ]);

        $builder->add(
            'support',
            TextType::class,
            [
                "label" => "Support de l'album"
            ]
        );

        $builder->add(
            'price',
            TextType::class,
            [
                "label" => "Prix de l'album"
            ]
        );
        
        $builder->add(
            'save',
            SubmitType::class, 
            [
                "label" => "Enregistrer"
            ]
        );
    }
}
