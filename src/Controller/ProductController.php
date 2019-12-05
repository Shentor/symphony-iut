<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product.index")
     */
    public function index(ProductRepository $productRepository)
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products, 
        ]);
    }

    /**
    *@Route("/product/{id}", name="product.show")
    */
    public function show($id){
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $products = $productRepository->find($id);
        if (!$products) {
            throw $this->createNotFoundException('The product does not exist');
        }

        return $this->render('product/show.html.twig', [
            'products' => $products, 
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier")
     */
    public function add($id, SessionInterface $session)
    {
    $panier = $session->get('panier', []);
    $panier[$id] = 1;
    $session->set('panier', $panier);
    }
}
