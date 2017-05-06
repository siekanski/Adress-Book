<?php

namespace AddressBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('city', 'text', array('label'=>'Miasto'))
                ->add('street','text', array('label'=>"Ulica"))
                ->add('streetNumber', 'text', array('label'=>"Numer domu"))
                ->add('streetNumber2', 'text', array('label'=>"Numer mieszkania"))
                ->add('postcode', 'text', array('label'=>'Kod pocztowy'))
                ->add('Zapisz', 'submit', array('attr' => array('class'=>'btn btn-primary')))
        ;
    }
    public function getName() {
        
    }
    
}

