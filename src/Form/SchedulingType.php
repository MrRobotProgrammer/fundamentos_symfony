<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchedulingType extends AbstractType
{
    /**
     * Define configuração inpput sheduling
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'widget' => 'single_text',
            'label' => 'Data ',
            'attr' => []
        ]);
    }

    /**
     * Define o tipo para o campo que será herdado
     * @return string|null
     */
    public function getParent()
    {
        return DateTimeType::class;
    }

}
