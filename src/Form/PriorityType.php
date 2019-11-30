<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriorityType extends AbstractType
{

    /**
     * Define configuração do formulário
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
            'label' => 'prioridade',
            'placeholder' => 'Selecione uma opção',
            'multiple'    => true,
            'mapped' => false
        ]);
    }

    /**
     * Define o tipo de campo que será herdado
     *
     * @return void
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}

