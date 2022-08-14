<?php

namespace App\Form;

use App\Entity\Authors;
use App\Repository\AuthorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AddBookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('author', EntityType::class, [
                'class' => Authors::class,
                'query_builder' => function (AuthorRepository $er) {


                },
                'choice_label' => function ($author) {
                    return $author->getSurname();
                },

            ])
            ->add('description')
            ->add('img', FileType::class, array('data_class' => null, 'label' => 'Image', 'required' => false, 'mapped' => false))
            ->add('year');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
