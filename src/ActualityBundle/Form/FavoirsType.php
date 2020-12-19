<?php

namespace ActualityBundle\Form;

use ActualityBundle\Entity\Actualites;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

class FavoirsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('actualite',EntityType::class,array('class'=>Actualites::class , 'choice_label'=>'id', 'multiple'=>false))
            ->add('user',EntityType::class,array('class'=>User::class , 'choice_label'=>'id', 'multiple'=>false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ActualityBundle\Entity\Favoirs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'actualitybundle_favoirs';
    }


}
