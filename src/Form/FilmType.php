<?php

namespace App\Form;

use App\Entity\Casting;
use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('annee')
            ->add('duree')
            ->add('synopsis')
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('acteurs', EntityType::class, [
                'class' => Casting::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('realisateurs', EntityType::class, [
                'class' => Casting::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
