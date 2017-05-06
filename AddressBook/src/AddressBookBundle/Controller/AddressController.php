<?php

namespace AddressBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AddressBookBundle\Entity\Address;
use AddressBookBundle\Form\Type\AddressType;


class AddressController extends Controller
{
    
    /**
     * @Route("/addAddress/{id}")
     * @Template()
     */
    public function addAddressAction(Request $req, $id) {
        
        $address = new Address();
        $person = $this->getDoctrine()->getRepository('AddressBookBundle:Person')->find($id);
        $form = $this->createForm(new AddressType(), $address);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $newAddress = $form->getData();
            $newAddress->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($newAddress);
            $em->flush();
            return $this->redirectToRoute('user',array('id'=> $id));
        }
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/modifyAddress/{addressId}", name="modifyAddress")
     * @Template("AddressBookBundle:Address:addAddress.html.twig")
     */
    public function modifyAddressAction(Request $req, $addressId) {
        
        $addressToEdit = $this->getDoctrine()->getRepository('AddressBookBundle:Address')->find($addressId);
        $personId = $addressToEdit->getPerson()->getId();
        
        $form = $this->createForm(new AddressType(), $addressToEdit);
        $form->handleRequest($req);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $newAddress = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($newAddress);
            $em->flush();
            return $this->redirectToRoute('user',array('id'=> $personId));
        }
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("deleteAddress/{addressId}/{personId}", name="deleteAddress")
     * @Template()
     */
    
    public function deleteAddressAction($addressId, $personId) {
        
        $em = $this->getDoctrine()->getManager();
        $addressToDelete = $this->getDoctrine()->getRepository('AddressBookBundle:Address')->find($addressId);
        $em->remove($addressToDelete);
        $em->flush();
       
        return $this->redirectToRoute('user',array('id'=> $personId));
    }
}
