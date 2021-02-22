<?php

namespace AppBundle\Form;


use AppBundle\Validator\Constraints\ArrayElementLimit;
use AppBundle\Validator\Constraints\IsStringWithSeparators;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class TrackType
 * @package AppBundle\Form
 */
class TrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberList', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new IsStringWithSeparators(['separator' => ',']),
                    new ArrayElementLimit(['limit' => 10, 'separator' => ',']),
                ],
                'attr' => array('cols' => '40', 'rows' => '10'),
            ])
            ->add('find', SubmitType::class);
    }

}