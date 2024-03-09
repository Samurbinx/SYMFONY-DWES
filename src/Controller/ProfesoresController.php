<?php

namespace App\Controller;

use App\Entity\Profesores;
use App\Form\ProfesoresType;
use App\Repository\ProfesoresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProfesoresController extends AbstractController
{
    #[Route('/profesores', name: 'profesores_index', methods: ['GET'])]
    public function index(ProfesoresRepository $profesoresRepository): Response
    {
        $profesores = $profesoresRepository->findAll();
        
        return $this->render('profesores/index.html.twig', [
            'profesores' => $profesores,
        ]);
    }

    #[Route('/profesores/nuevo', name: 'profesores_nuevo', methods: ['GET', 'POST'])]
    public function nuevo(Request $request): Response
    {
        $profesor = new Profesores();
        $form = $this->createForm(ProfesoresType::class, $profesor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profesor);
            $entityManager->flush();

            return $this->redirectToRoute('profesores_index');
        }

        return $this->render('profesores/nuevo.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    

    #[Route('/profesores/{id}', name: 'profesores_detalle', methods: ['GET'])]
    public function detalle(Profesores $profesor): Response
    {
        return $this->render('profesores/detalle.html.twig', [
            'profesor' => $profesor,
        ]);
    }

    #[Route('/profesores/{id}/editar', name: 'profesores_editar', methods: ['GET', 'POST'])]
    public function editar(Request $request, Profesores $profesor): Response
    {
        $form = $this->createForm(ProfesoresType::class, $profesor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('profesores_index');
        }

        return $this->render('profesores/editar.html.twig', [
            'profesor' => $profesor,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profesores/{id}', name: 'profesores_eliminar', methods: ['DELETE'])]
    public function eliminar(Request $request, Profesores $profesor): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($profesor);
        $entityManager->flush();

        return $this->redirectToRoute('profesores_index');
    }
}
