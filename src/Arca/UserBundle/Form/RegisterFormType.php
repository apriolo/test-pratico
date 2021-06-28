<?php


namespace Arca\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Arca\UserBundle\Entity\User;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text')
            ->add('email', 'text',[
                "required" => true,
                "label" => "Email Address",
                "attr" => [
                    "class" => "CLASSTEST"
                ]
            ])
            ->add('password', 'repeated', [
                'type' => 'password'
            ])
            ->getForm();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            "data_class" => User::class
        ]);
    }

    public function getName()
    {

    }

}