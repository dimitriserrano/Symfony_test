<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="showproduct")
     */
    public function showproduct(Product $products): Response
    {
        return $this->render('product/show.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products
        ]);
    }
}
