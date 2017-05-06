<?php

namespace AddressBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name','text', array('label' => 'IMIĘ: '))
                ->add('surname', 'text', array('label' => 'NAZWISKO: '))
                ->add('description', 'text', array('label' => 'OPIS: '))
                ->add('photo', 'file', array('label' => 'FOTO: ','data'=>null))
                ->add('Zapisz', 'submit', array('attr' => array('class'=>'btn btn-primary')))
        ;
    }
    public function getName() {
        
    }
}

