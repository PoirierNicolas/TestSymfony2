<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TestBundle\Entity\Carnet;
use TestBundle\Entity\Contact;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TestBundle:Default:index.html.twig');
    }
    public function listecontactsAction()
    {
        $idUser = $this->getUser()->getId();
        $repoUser = $this->getDoctrine()->getRepository('TestBundle\Entity\User');
        $myUser = $repoUser->find($idUser);
        $repoCarnet = $this->getDoctrine()->getRepository('TestBundle\Entity\Carnet');
        $idContacts = $repoCarnet->findBy(array('User'=>$myUser));
        $contacts = array();
        foreach ( $idContacts as $item) {
            array_push($contacts, $item->getContacts());
        };
        $listeContacts = array();
        $repoContact = $this->getDoctrine()->getRepository('TestBundle\Entity\Contact');
        $allContacts = $repoContact->findAll();
        foreach ($allContacts as $unContact)
        {
            if (!in_array($unContact, $contacts))
            {
                array_push($listeContacts, $unContact);
            }
        }
        return $this->render('TestBundle:Default:listeContacts.html.twig', array("contacts" => $contacts, "listeContacts" => $listeContacts));
    }
    public function deletecontactAction()
    {
        $idUser = $this->getUser()->getId();
        $idContact = $this->get('request')->request->get('idContact');
        $em = $this->getDoctrine()->getEntityManager();
        $contact = $em->getRepository('TestBundle\Entity\Carnet')->find(array('User' => $idUser, 'contacts' => $idContact));
        $em->remove($contact);
        $em->flush();
        return $this->listecontactsAction();
    }
    public function creercontactAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $contact = new Contact();
        $contact->setNom($this->get('request')->request->get('modalName'));
        $contact->setAdresse($this->get('request')->request->get('modalAdresse'));
        $contact->setEmail($this->get('request')->request->get('modalEmail'));
        $contact->setPhone($this->get('request')->request->get('modalPhone'));
        $contact->setSite($this->get('request')->request->get('modalSite'));
        $em->persist($contact);
        $em->flush();
        return $this->listecontactsAction();
    }
    public function addcontactcarnetAction()
    {
        $idUser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getEntityManager();
        $repoUser = $this->getDoctrine()->getRepository('TestBundle\Entity\User');
        $myUser = $repoUser->find($idUser);
        $carnet = new Carnet();
        $carnet->setUser($myUser);
        $repoContact = $this->getDoctrine()->getRepository('TestBundle\Entity\Contact');;
        $contact = $repoContact->find($this->get('request')->request->get('modalAddContact'));
        $carnet->setContacts($contact);
        $em->persist($carnet);
        $em->flush();
        return $this->listecontactsAction();
    }
    public function editcontactAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repoContact = $this->getDoctrine()->getRepository('TestBundle\Entity\Contact');
        $contact = $repoContact->find($this->get('request')->request->get('idContact'));
        $contact->setNom($this->get('request')->request->get('modalName'));
        $contact->setAdresse($this->get('request')->request->get('modalAdresse'));
        $contact->setEmail($this->get('request')->request->get('modalEmail'));
        $contact->setPhone($this->get('request')->request->get('modalPhone'));
        $contact->setSite($this->get('request')->request->get('modalSite'));
        $em->merge($contact);
        $em->flush();
        return $this->listecontactsAction();
    }
    
}
