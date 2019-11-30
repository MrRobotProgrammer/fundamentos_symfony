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
                'attr' => ['placeholder' => 'Titulo', 'required' => false],
                'label' => 'Titulo'
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Email'],
                'label' => 'Email',
                'mapped' => false
            ])
            ->add('escolha', PriorityType::class)
            ->add('scheduling', DateTimeType::class, [
                'attr' => [],
                'label' => 'Agendamento',
                'widget' => 'single_text',
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['placeholder' => 'Descricao'],
                'label' => 'Descricao'

            ])
            ->add('create', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'required' => true,
            'mapped' => true
        ]);
    }
  }
