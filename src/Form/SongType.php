<?php

namespace App\Form\Type;

use App\Entity\Album;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class SongType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {   

        $builder->add(
            'title',
            TextType::class,
            [
                "label" => "Titre de la musique"
            ]
        );

        $builder->add(
            'album',
            EntityType::class,
            [
                "label" => "Titre de l'album", 
                'class' => Album::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => false
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
