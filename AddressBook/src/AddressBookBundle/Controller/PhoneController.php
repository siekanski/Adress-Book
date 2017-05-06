<?php

namespace AddressBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AddressBookBundle\Entity\Phone;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhoneController extends Controller
{
    /**
     * @Route("/addPhone/{id}")
     * @Template()
     */
    public function addPhoneAction(Request $req, $id) {
        
        $phone = new Phone();
        $person = $this->getDoctrine()->getRepository('AddressBookBundle:Person')->find($id);
        $form = $this->createFormBuilder($phone)
                ->add('number', 'text', array('label'=>'Numer'))
                ->add('type','choice', array('label'=>"Typ", 'choices' => ['Komórkowy' => 'Komórkowy',"Domowy" => "Domowy", "Służbowy" => "Służbowy"]))
                ->add('Zapisz', 'submit', array('attr' => array('class'=>'btn btn-primary')))
                ->getForm();
        $form->handleRequest($req);
        
        if($req->getMethod() === 'POST') {
            if ($form->isSubmitted() && $form->isValid()) {
                $newPhone = $form->getData();
                $newPhone->setPerson($person);
                $em = $this->getDoctrine()->getManager();
                $em->persist($newPhone);
                $em->flush();
                return $this->redirectToRoute('user',array('id'=> $id));
            }
        }
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/modifyPhone/{phoneId}", name="modifyPhone")
     * @Template("AddressBookBundle:Phone:addPhone.html.twig")
     */
    public function modifyPhoneAction(Request $req, $phoneId) {
        
        $phoneToEdit = $this->getDoctrine()->getRepository('AddressBookBundle:Phone')->find($phoneId);
        $personId = $phoneToEdit->getPerson()->getId();
        
        $phoneType = $phoneToEdit->getType();
        switch ($phoneType) {
            case "Komórkowy":
                $choice = [
                    'Komórkowy' => 'Komórkowy',
                    'Domowy' => 'Domowy', 
                    'Służbowy' => 'Służbowy'
                ];
                break;
            case "Domowy":
                $choice = [
                    'Domowy' => 'Domowy',
                    'Komórkowy' => 'Komórkowy',
                    'Służbowy' => 'Służbowy'
                ];
                break;
            case "Służbowy":
                $choice = [
                    'Służbowy' => 'Służbowy',
                    'Domowy' => 'Domowy',
                    'Komórkowy' => 'Komórkowy',
                ];
                break;
            default :
                throw new NotFoundHttpException("Ups. Something went wrong!");
        }
        
        $form = $this->createFormBuilder($phoneToEdit)
                ->add('number', 'text', array('label'=>'Numer'))
                ->add('type','choice', array('label'=>"Typ", 'choices' => $choice))
                ->add('Zapisz', 'submit', array('attr' => array('class'=>'btn btn-primary')))
                ->getForm();
        $form->handleRequest($req);
        
        if($req->getMethod() === 'POST') {
            if($form->isSubmitted() && $form->isValid()) {
                $newPhone = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($newPhone);
                $em->flush();
                return $this->redirectToRoute('user',array('id'=> $personId));
            }
        }
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("deletePhone/{phoneId}/{personId}", name="deletePhone")
     * @Template()
     */
    
    public function deleteEmailAction($phoneId, $personId) {
        
        $em = $this->getDoctrine()->getManager();
        $phoneToDelete = $this->getDoctrine()->getRepository('AddressBookBundle:Phone')->find($phoneId);
        $em->remove($phoneToDelete);
        $em->flush();
       
        return $this->redirectToRoute('user',array('id'=> $personId));
    }
    
}
