<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('image', FileType::class,  array('data_class' => null))
            ->add('marque',EntityType::class, array(
                'class'            => 'AppBundle:Marque',
                'choice_label' => 'nom',
                'multiple'     => false,
            ))
            ->add('pieceDetaches', EntityType::class, array(
                'class'            => 'AppBundle:PieceDetacheTranslation',
                'choice_label' => 'nom',
                'multiple'     => true,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Voiture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_voiture';
    }


}
