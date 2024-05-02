<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;



class PresentationController extends AbstractController
{
    #[Route('/Presentation', name: 'Presentation.index')]
    public function index(Request $request): Response
    {
        return $this->render('Presentation/index.html.twig');
    }
    #[Route('/Presentation/{slug}-{id}', name: 'Presentation.show')]
    public function show(Request $request, string $slug, int $id): Response
    {
       
       
        return $this->render('Presentation/show.html.twig', [
            'slug' => $slug,
            'id' => $id

        ]);
        
    }
}
