<?php

namespace App\Form;

use App\Entity\Acteurs;
use App\Entity\Films;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ActeursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom')
            ->add('dateDeNaissance', BirthdayType::class)
            ->add('dateDeMort', BirthdayType::class,[
                'required'=>false
            ])
          
            ->add('photo',FileType::class,[

                'data_class'=>null
           
            ])
            
            ->add('Valider',SubmitType::class);
            
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Acteurs::class,
        ]);
    }
}
?>
