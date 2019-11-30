<?php
namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Titulo'],
                'label' => 'Titulo',
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Email'],
                'label' => 'Email',
                'required' => true,
                'mapped' => false
            ])
            ->add('priority', PriorityType::class)
            ->add('scheduling', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Data ',
                'attr' => []
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['placeholder' => 'Descrição'],
                'label' => 'Descrição',
                'required' => true
            ])
            ->add('create', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class
        ]);
    }
}

