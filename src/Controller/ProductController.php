<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController {
    /**
     * @var ProductRepository
     */

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/products", name="product.index")
     * @return Response
     *
     */
    public function index(): Response {
        $product = new Product();
        $product->setTitle('Iphone 11')
            ->setDescription('646')
            ->setPrice(1000);
        $en = $this->getDoctrine()->getManager();
        $en->persist($product);
        $en->flush();
        return $this->render('product/index.html.twig', [
            'current_menu' => 'products'
        ]);
    }

    /**
     * @Route("/products/{slug}-{id}", name="product.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param  Product $product
     * @return Response
     */
    public function show(Product $product, string $slug):Response
    {
        if($product->getSlug() !== $slug)  {
            return $this->redirectToRoute('product.show', [
                'id' => $product->getId(),
                'slug' => $product->getSlug()
            ], 301);
        }
        $product = $this->repository->find($product->getId());
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'current_menu' => 'products'
        ]);
    }
}