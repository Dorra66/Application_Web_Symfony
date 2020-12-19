<?php

namespace MuseumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandevisiteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('source')->add('nomorganismed')->add('nomresponsabled')->add('numteld')->add('maild')->add('addpostaled')->add('datevisited')->add('heurevisited')->add('nbrevisiteursd')->add('etatdv');
        $builder->add('nomorganismed', ChoiceType::class,
            [
                //'label' => 'Status :',
                'required' => false,
                'choices' => array(
                    'Association' => 'Association',
                    'Kindergarten' => 'Kindergarten',
                    'Primary school' => 'Primary school',
                    'High school' => 'High school',
                    'University' => 'University',
                    'Group of tourist' => 'Group of tourist',
                    'Individual visit' => 'Individual visit'
                ),
                'placeholder' => 'Select a type ...',
            ])->add('nomresponsabled')->add('numteld')->add('maild')->add('addpostaled')->add('datevisited')
            ->add('heurevisited', ChoiceType::class,
            [
                //'label' => 'Status :',
                'required' => false,
                'choices' => array(
                    '08:00' => '08:00',
                    '09:00' => '09:00',
                    '10:00' => '10:00',
                    '11:00' => '11:00',
                    '12:00' => '12:00',
                    '13:00' => '13:00',
                    '14:00' => '14:00',
                    '15:00' => '15:00',
                    '16:00' => '16:00',
                    '17:00' => '17:00',
                ),
                'placeholder' => 'Select an hour ...',
            ])->add('nbrevisiteursd')->add('etatdv');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MuseumBundle\Entity\Demandevisite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'museumbundle_demandevisite';
    }


}
