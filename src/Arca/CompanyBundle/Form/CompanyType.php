<?php

namespace Arca\CompanyBundle\Form;

use Arca\CategoryBundle\Entity\Category;
use Arca\CategoryBundle\Form\CategoriesType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Arca\CompanyBundle\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title', 'text',[
            "required" => false
        ])
            ->add('telephone')
            ->add('address')
            ->add('postalcode')
            ->add('city')
            ->add('state')
            ->add('description')
            ->add('categories', EntityType::class, [
                    'class' => Category::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->orderBy('c.title', 'ASC');
                    },
                    'choice_label' => 'title',
                    'multiple' => true,
                    'expanded' => true,
//                    'label_attr' => ['class' => 'form-check-label'],
//                    'attr' => ['class' => 'form-check-input mr-4']
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Company::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'arca_companybundle_company';
    }


}
