<?php

namespace App\Form;

use App\Entity\Acteurs;
use App\Entity\Films;
use App\Entity\Genres;
use DateTimeInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('resume',TextType::class)
            ->add('AnneeDeSortie',IntegerType::class)
            ->add('Affiche',FileType::class,[
               'data_class'=>null
            ])
            ->add('Genre', EntityType::class, [
               
                'class' => Genres::class,
                'choice_label' => 'nom',
                ])
                ->add('acteurs', EntityType::class,[
                    'class' => Acteurs::class,
                    'choice_label' => 'nom',
                    'expanded' => true,
                    'multiple' => true,
                    
                ])
                    
              
            ->add('Ajouter',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           
            'data_class' => Films::class,
           
        ]);
    }
}
