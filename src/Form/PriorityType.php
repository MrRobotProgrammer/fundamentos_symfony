<?php
namespace App\Form;

  use App\Entity\Task;
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\OptionsResolver\OptionsResolver;

  class PriorityType extends AbstractType
  {

      /**
       * Define campo do formulário
       *
       * @param OptionsResolver $resolver
       * @return void
       */
      public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'Baixa' => 'Baixa',
                'Media' => 'Media',
                'Alta' => 'Alta'
            ],
            'label' => 'Prioridade',
            'placeholder' => 'Selecione uma opção',
            'multiple' => true,
            'mapped' => false
        ]);
    }

      /**
       * Define o tipo que o campo será herdado
       *
       * @return string|null
       */
    public function getParent()
    {
        return ChoiceType::class;
    }
  }
