<?php
namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class AnnonceProdType extends AbstractType
{
/**
* {@inheritdoc}
*/
public function buildForm(FormBuilderInterface $builder, array $options)
{

$builder
->add('nomProd')
->add('description')
->add('stock')
->add('prix')
->add('image', FileType::class, array('data_class' => null));
} /**
* {@inheritdoc}
*/
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array(
'data_class' => 'MainBundle\Entity\AnnonceProd'
));
}

/**
* {@inheritdoc}
*/
public function getBlockPrefix()
{
return 'mainbundle_annonceprod';
}


}
