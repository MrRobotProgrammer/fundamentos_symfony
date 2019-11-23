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
                'attr' => ['class' => 'form-control', 'placeholder' => 'Titulo', 'required' => false],
                'required' => true,
                'label' => 'Titulo'
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Email'],
                'label' => 'Email',
                'mapped' => false,
                'required' => true
            ])
            ->add('escolha', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'placeholder' => 'Selecione',
                'choices' => [
                    'Quero participar' => 1,
                    'Não quero participar' => 2,
                    'Estou em duvida' => 3,
                    'Tenho interesse' => 4,
                ],
                'label' => 'Evento ',
                'multiple' => true,
                'mapped' => false,
                'required' => true
            ])
            ->add('scheduling', DateTimeType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Agendamento',
                'widget' => 'single_text'
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Descricao'],
                'required' => true,
                'label' => 'Descricao'

            ])
            ->add('Salvar', SubmitType::class, [
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
