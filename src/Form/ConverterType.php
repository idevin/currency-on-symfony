<?php

namespace App\Form;

use App\Entity\Currency;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConverterType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('value', NumberType::class, [
                'mapped' => false,
            ])
            ->add('from', EntityType::class, [
                'mapped' => false,
                'class' => Currency::class,
                'choice_label' => 'symbol'
            ])
            ->add('to', EntityType::class, [
                'mapped' => false,
                'class' => Currency::class,
                'choice_label' => 'symbol'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Currency::class,
        ]);
    }
}
