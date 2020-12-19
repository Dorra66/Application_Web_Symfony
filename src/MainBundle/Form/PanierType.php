<?php

namespace MainBundle\Form;

use MainBundle\Entity\AnnonceProd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PanierType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder ->add('id')
            ->add('user',EntityType::class,array('class'=>User::class,'placeholder' => ' ',
                'choice_label'=>function($type){
                    return $type->getName();},
                'multiple'=>false))
            ->add('produit',EntityType::class,array('class'=>AnnonceProd::class,'placeholder' => ' ',
                'choice_label'=>function($type){
                    return $type->getName();},
                'multiple'=>false));
    } /**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Panier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_panier';
    }


}
