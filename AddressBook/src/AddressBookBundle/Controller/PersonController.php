<?php

namespace AddressBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use AddressBookBundle\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use AddressBookBundle\Form\Type\PersonType; 

class PersonController extends Controller
{
    
    /**
     * @Route("/new", name="new")
     * @Template()
     */
    public function newAction(Request $req) {
        
        $loggedUser = $this->container->get('security.context')->getToken()->getUser();
        $person = new Person();
        $form = $this->createForm(new PersonType(),$person);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $newPerson = $form->getData();
            $newPerson->setUser($loggedUser);
            if($newPerson->getPhoto() !== null) {
                $file = $newPerson->getPhoto();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move('photos',$fileName);
                $newPerson->setPhoto($fileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($newPerson);
            $em->flush();
            $id = $newPerson->getId();
            return $this->redirectToRoute('user',array('id'=> $id));
        }
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/", name="/")
     * @Template()
     */
    public function showAllAction(Request $req) {
        
        $loggedUser = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM AddressBookBundle:Person p
            WHERE p.user = :loggedUser ORDER BY p.surname'
            )->setParameter('loggedUser', $loggedUser);
        $persons = $query->getResult();
        
         $form = $this->createFormBuilder()
                ->add('search','search', array('label'=>false))
                ->add('Szukaj', 'submit', array('attr' => array('class'=>'btn btn-primary')))
                ->getForm();
        $form->handleRequest($req);
        if($req->getMethod() === 'POST') {
            if ($form->isSubmitted() && $form->isValid()) {
            
                $toSearch = $form->getData();
                $personsRepo = $this->getDoctrine()->getRepository('AddressBookBundle:Person');
                $persons = $personsRepo->searchPersonsByName($toSearch, $loggedUser);
        
                return array('persons' => $persons, 'form' => $form->createView());
            }
        }
        return array('persons' => $persons, 'form' => $form->createView());
    }
    
    /**
     * @Route("user/{id}", name="user")
     * @Template()
     */
    public function showPersonAction($id) {
        
        $rep = $this->getDoctrine()->getRepository('AddressBookBundle:Person');
        $person = $rep->find($id);
        $addresses = $this->getDoctrine()->getRepository('AddressBookBundle:Address')->findByPerson($id);
        $emails = $this->getDoctrine()->getRepository('AddressBookBundle:Email')->findByPerson($id);
        $phones = $this->getDoctrine()->getRepository('AddressBookBundle:Phone')->findByPerson($id);
        
        if (!$person) {
            return new Response("<h3>Brak wyników wyszukiwania</h3>");
        }
        
        return array(   'person' => $person, 
                        'addresses'=>$addresses, 
                        'emails' => $emails,
                        'phones' => $phones);
    }
    
    /**
     * @Route("/{id}/modify")
     * @Template()
     */
    public function modifyPersonAction(Request $req, $id) {
       
        $rep = $this->getDoctrine()->getRepository('AddressBookBundle:Person');
        $person = $rep->find($id);
      
        if(!$person) {
            return $this->redirectToRoute("/");
        }
        $photo = $person->getPhoto();
        
        $form = $this->createForm(new PersonType(),$person);
        $form->handleRequest($req);
     
        if ($form->isSubmitted() && $form->isValid()) {
            $newPerson = $form->getData();
            if($newPerson->getPhoto() == null) {
                $newPerson->setPhoto($photo);
            } else {
                if($photo != null) {
                    unlink('photos/'."$photo");
                }
                $file = $newPerson->getPhoto();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move('photos',$fileName);
                $newPerson->setPhoto($fileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('user',array('id'=> $id));
        }
        return array('form' => $form->createView());        
    }
    
    /**
     * @Route("/{id}/delete")
     */
    public function deleteUserAction($id) {
        
        $userToDel = $this->getDoctrine()->getRepository('AddressBookBundle:Person')->find($id);
        
        if(!$userToDel) {
            return new Response('Brak użytkownika do usunięcia');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($userToDel);
        $em->flush();
        return $this->redirectToRoute('/');
    }
    
    /**
     * @Route("/{id}/addToGroup", name="addToGroup")
     * @Template()
     */
    public function addToGroupAction(Request $req, $id) {
        
        $person = $this->getDoctrine()->getRepository('AddressBookBundle:Person')->find($id);
        
        if(!$person){
            return $this->redirectToRoute("/");
        }
        $groupTest = "";
        $groupTestId = "";
        foreach($person->getGroups() as $group) {
            $groupTest = $group->getGroupName();
            $groupTestId = $group->getId();
            $userGroup = $group;
        }
        
        $form = $this->createFormBuilder()
                ->add('groups','entity', array('label'=>'Grupa','class'=>'AddressBookBundle:Groups','choice_label'=>'groupName'))
                ->add('Zapisz', 'submit',array('attr' => array('class'=>'btn btn-primary')))
                ->getForm();
        $form->handleRequest($req);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $groups = $formData['groups'];
            $groupId = $groups->getId();
            $groupName = $groups->getGroupName();
            if($groupTest == "") {
                $group = $this->getDoctrine()->getRepository('AddressBookBundle:Groups')->find($groupId);
                $group->addPerson($person);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }
            elseif($groupTest !== $groupName) {
                $group = $this->getDoctrine()->getRepository('AddressBookBundle:Groups')->find($groupId);
                $person->removeGroup($userGroup);
                $group->addPerson($person);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }
            return $this->redirectToRoute('user',array('id'=> $id));
        }
        return array('form' => $form->createView());       
    }
    
    /**
     * @Route("{id}/deleteGroup", name="deleteGroup")
     */
    public function deleteGroupAction($id) {
        
        $person = $this->getDoctrine()->getRepository('AddressBookBundle:Person')->find($id);
        
        foreach($person->getGroups() as $group) {
            $userGroup = $group;
        }
        
        if($userGroup) {
            $person->removeGroup($group);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        return $this->redirectToRoute('user',array('id'=> $id));
    }
    
   
}
