<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('content', TextareaType::class, [
                'label' => "Contenu",
                "attr" => [
                    "placeholder" => "Contenu de l'article"
                ]
            ])
            ->add('user_id', EntityType::class, [
                "label" => "Auteur",
                "class" => Utilisateur::class
                // ,
                // "choice_label" => function($user){
                //     return $user->getNom();
                // }
            ])
            ->add("Ajouter", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
