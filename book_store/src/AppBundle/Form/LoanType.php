<?php

namespace AppBundle\Form;

use AppBundle\Entity\Book;
// use AppBundle\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class LoanType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('name');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        #    Resolver
        $resolver->setDefaults(array(
            'data_class' => Book::class
        ));
    }
}