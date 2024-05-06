<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Reservation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duree')
            ->add('dateArrivee', null, [
                'widget' => 'single_text'
            ])
            ->add('datedepart', null, [
                'widget' => 'single_text'
            ])
            ->add('client', EntityType::class,[
                'class' => Client::class,
                'choice_label' => 'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
