<?php

namespace AddressBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AddressBookBundle\Entity\Email;
use AddressBookBundle\Form\Type\EmailType;

class EmailController extends Controller
{
    
    /**
     * @Route("/addEmail/{id}")
     * @Template()
     */
    public function addEmailAction(Request $req, $id) {
        
        $email = new Email();
        $person = $this->getDoctrine()->getRepository('AddressBookBundle:Person')->find($id);
        $form = $this->createForm(new EmailType(), $email);
        $form->handleRequest($req);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $newEmail = $form->getData();
            $newEmail->setPerson($person);
            $em = $this->getDoctrine()->getManager();
            $em->persist($newEmail);
            $em->flush();
            return $this->redirectToRoute('user',array('id'=> $id));
        }
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/modifyEmail/{emailId}", name="modifyEmail")
     * @Template("AddressBookBundle:Email:addEmail.html.twig")
     */
    public function modifyEmailAction(Request $req, $emailId) {
        
        $emailToEdit = $this->getDoctrine()->getRepository('AddressBookBundle:Email')->find($emailId);
        $personId = $emailToEdit->getPerson()->getId();
        
        $form = $this->createForm(new EmailType(), $emailToEdit);
        $form->handleRequest($req);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $newEmail = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($newEmail);
            $em->flush();
            return $this->redirectToRoute('user',array('id'=> $personId));
        }
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("deleteEmail/{emailId}/{personId}", name="deleteEmail")
     * @Template()
     */
    
    public function deleteEmailAction($emailId, $personId) {
        
        $em = $this->getDoctrine()->getManager();
        $emailToDelete = $this->getDoctrine()->getRepository('AddressBookBundle:Email')->find($emailId);
        $em->remove($emailToDelete);
        $em->flush();
       
        return $this->redirectToRoute('user',array('id'=> $personId));
    }
}
