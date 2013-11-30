<?php

namespace Blogger\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add(
                'post',
                null,
                array(
                    'label' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'bbcode'
                    )
                )
            )
            ->add(
                'category',
                null,
                array(
                    'required' => true,
                )
            )
            ->add(
                'image',
                null,
                array(
                    'required' => false,
                )
            )
            ->add(
                'tagString',
                null,
                array(
                    'required' => false,
                    'label' => 'Tags',
                )
            )
            ->add(
                'posted',
                null,
                array(
                    'required' => false,
                )
             )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blogger\BlogBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogger_blogbundle_post';
    }
}
