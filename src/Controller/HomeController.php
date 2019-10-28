<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param ProductRepository $repository
     * @return Response
     * @Route("/", name="home")
     */

    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findLatest();

        return $this->render('pages/home.html.twig', [
            'products' => $products
        ]);
    }
}