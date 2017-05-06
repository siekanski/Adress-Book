<?php

namespace AddressBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('email_address', 'email', array('label'=>'Adres email'))
                ->add('email_type','choice', array('label'=>"Typ", 'choices' => ['Dom' => 'Dom',"Praca" => "Praca"]))
                ->add('Zapisz', 'submit', array('attr' => array('class'=>'btn btn-primary')))
        ;
    }
    public function getName() {
        
    }
}

