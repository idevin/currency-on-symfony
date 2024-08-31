<?php

namespace App\Form;

use App\Entity\Data;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('symbol')
            ->add('name')
            ->add('symbol_native')
            ->add('decimal_digits')
            ->add('rounding')
            ->add('code')
            ->add('name_plural')
            ->add('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Data::class,
        ]);
    }
}
