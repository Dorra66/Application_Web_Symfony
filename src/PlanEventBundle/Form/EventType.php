<?php

namespace PlanEventBundle\Form;
use Symfony\Component\V;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomevent')
            ->add('categorieevent',ChoiceType::class,['required' => 'false','choices' => array(
                'Theater' => 'Theater',
                'Film' => 'Film',
                'Cultural' => 'Cultural'
            ),
                'placeholder' => '-------------',
            ])
            ->add('nbrplacedispo')
            ->add('dateevent')
            ->add('heureevent',ChoiceType::class,['required' => 'false','choices' => array(
                '10:00' => '10:00',
                '11:00' => '11:00',
                '12:00' => '12:00',
                '14:00' => '14:00',
                '15:00' => '15:00',
                '16:00' => '16:00',
                '17:00' => '17:00',
                '18:00' => '18:00',
                '19:00' => '19:00',
                '20:00' => '20:00'

            ),
                'placeholder' => '-------------',
            ])
            ->add('affiche','Symfony\Component\Form\Extension\Core\Type\FileType',array('data_class' => null));


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanEventBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'planeventbundle_event';
    }


}
