<?php

namespace PlanEventBundle\Form;

use PlanEventBundle\Entity\Event;
use PlanEventBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('iduser',EntityType::class,array('class'=>User::class,'choice_label'=>'username',
            'multiple'=>false))
            ->add('idevent',EntityType::class,array('class'=>Event::class,'choice_label'=>'nomevent',
            'multiple'=>false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanEventBundle\Entity\Participation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'planeventbundle_participation';
    }


}
