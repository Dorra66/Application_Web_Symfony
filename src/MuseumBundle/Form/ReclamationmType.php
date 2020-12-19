<?php

namespace MuseumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationmType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idsource')->add('rolesource')->add('objetreclamation')->add('descriptionreclamation', TextareaType::class, [
            'attr' => ['class' => 'form-control','rows'=>'4']])->add('datereclamation')->add('statutsreclamation')->add('reponsereclamation', TextareaType::class, [
            'attr' => ['class' => 'form-control','rows'=>'4','cols'=>'87']])->add('destinationreclamation');
        //$builder->add('objetreclamation')->add('descriptionreclamation');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MuseumBundle\Entity\Reclamationm'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'museumbundle_reclamationm';
    }


}
