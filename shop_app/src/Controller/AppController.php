<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Contact;
use App\Entity\PropertySearch;
use App\Repository\ProductRepository;
use App\Form\PropertySearchType;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/app", name="app")
     */
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(ProductRepository $prodrepo): response
    {
        $products = $prodrepo->findAll();
        return $this->render('app/home.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/listeproduit", name="allproduct")
     */
    public function allproduct(ProductRepository $prodrepo, Request $request): response
    {
        $products = $prodrepo->findAll();
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);

        
        if($form->isSubmitted() && $form->isValid()) {

            $name = $propertySearch->getName();   
            if ($name!="") 
            $products= $this->getDoctrine()->getRepository(Product::class)->findBy(['name' => $name] );
            else   
            $products = $prodrepo->findAll();
        }
        return  $this->render('app/listproduct.html.twig',[
            'form' =>$form->createView(),
            'products' => $products,
            ]);  
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request): response
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::Class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $contact->setcontactDate(new \DateTime());
            $contact->setcreated(new \DateTime());
            $this->getDoctrine()->getManager()->persist($contact);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('app/contact.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function panier(SessionInterface $session, ProductRepository $prodrepo): response
    {
        $panier = $session->get('panier', []);

        $panierdata = [];

        foreach($panier as $id => $quantity) {
            $panierdata[] = [
                'product' => $prodrepo->find($id),
            ];
        }

        return $this->render('app/panier.html.twig', [
            'items' => $panierdata
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panieradd")
     */
    public function panieradd($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        $panier[$id] = 1;
        $session->set('panier', $panier);

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/panier/remove/{id}", name="panierremove")
     */
    public function remove($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("panier");
    }
    
}
