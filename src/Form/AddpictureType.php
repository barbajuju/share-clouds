<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\DateTime;

class AddpictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre :'])
            ->add('image', FileType::class, array('label' => 'Image (PNG, JPG ou JPEG) :'))
            ->add('geolocalisation')
            ->add('comment', TextType::class, ['label' => 'Commentaire :'])
            ->add('submit', SubmitType::class, [
                "label" => "Ajoutez votre nuage"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Picture::class,
        ));
    }
}
