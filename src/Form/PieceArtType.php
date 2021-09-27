<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\PieceOfArt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PieceArtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description',TextareaType::class, [
                'attr' => ['rows' => 10]])
            ->add('date', DateType::class, [
                'label' => 'Année',
                'widget' => 'single_text',
                ])
            ->add('photo', FileType::class, [
                'mapped' => false,
                'label' => 'Photo',
            ])
            ->add('artist', EntityType::class, ['class' => Artist::class, 'choice_label'=>'name', 'multiple'=>false, 'expanded'=> true])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PieceOfArt::class,
        ]);
    }
}
