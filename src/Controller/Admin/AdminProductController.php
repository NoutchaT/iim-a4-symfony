<?php
namespace App\Controller\Admin;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class AdminProductController extends AbstractController
{
    /**
     * @param ProductRepository $repository
     * @return Response
     * @Route("/admin", name="admin.product.index")
     */
    public function index(ProductRepository $repository)
    {
        $products = $repository->findAll();
        return $this->render('admin/product/index.html.twig', compact('products'));
    }
    /**
     * @param ProductRepository $repository
     * @param Product $product
     * @return Response
     * @Route("/admin/{id}", name="admin.product.edit")
     */
    public function edit(ProductRepository $repository, Product $product)
    {
        $form = $this->createForm(ProductType::class, $product);
        return $this->render('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);

    }
}