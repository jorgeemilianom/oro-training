<?php

namespace Acme\Bundle\DemoBundle\Form\Type;

use Acme\Bundle\DemoBundle\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Document entity.
 */
class DocumentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'acme.demo.document.form.name.label', 
                ]
            )
            ->add(
                'type',
                ChoiceType::class,
                [
                    'label' => 'acme.demo.document.form.type.label',
                    'required' => true,
                    'choices' => [
                        'acme.demo.document.form.type.local' => 'local',
                        'acme.demo.document.form.type.web' => 'web', 
                        'acme.demo.document.form.type.dual' => 'dual', 
                    ],
                    'placeholder' => false,
                ]
            )
            ->add(
                'description',
                TextType::class,
                ['label' => 'acme.demo.document.form.description.label', 'required' => false]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class
        ]);
    }
}
