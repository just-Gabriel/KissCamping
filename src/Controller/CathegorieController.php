<?php

namespace App\Controller;

use App\Entity\Cathegorie;
use App\Form\CathegorieType;
use App\Repository\CathegorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cathegorie')]
class CathegorieController extends AbstractController
{
    #[Route('/', name: 'app_cathegorie_index', methods: ['GET'])]
    public function index(CathegorieRepository $cathegorieRepository): Response
    {
        return $this->render('cathegorie/index.html.twig', [
            'cathegories' => $cathegorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cathegorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cathegorie = new Cathegorie();
        $form = $this->createForm(CathegorieType::class, $cathegorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cathegorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_cathegorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cathegorie/new.html.twig', [
            'cathegorie' => $cathegorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cathegorie_show', methods: ['GET'])]
    public function show(Cathegorie $cathegorie): Response
    {
        return $this->render('cathegorie/show.html.twig', [
            'cathegorie' => $cathegorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cathegorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cathegorie $cathegorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CathegorieType::class, $cathegorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cathegorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cathegorie/edit.html.twig', [
            'cathegorie' => $cathegorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cathegorie_delete', methods: ['POST'])]
    public function delete(Request $request, Cathegorie $cathegorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cathegorie->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($cathegorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cathegorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
