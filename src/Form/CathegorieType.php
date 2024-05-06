<?php

namespace App\Form;

use App\Entity\Cathegorie;
use App\Entity\Logement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CathegorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prix')
            ->add('logement', EntityType::class,[
                'class' => Logement::class,
                'choice_label' => 'nbPlace',
                'attr' => [
                    'placeholder' => 'Nombre de Places'
                    ]
                    
            ])
            
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cathegorie::class,
        ]);
    }
    
}
// VOIR PKOI LE PLACHOLDER N 4AI PAS PRIS EN COMPTE ?????? 