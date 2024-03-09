<?php

namespace App\Controller;

use App\Entity\Departamentos;
use App\Repository\DepartamentosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartamentosController extends AbstractController
{
    #[Route('/departamentos', name: 'departamentos_index', methods: ['GET'])]
    public function index(DepartamentosRepository $departamentosRepository): Response
    {
        $departamentos = $departamentosRepository->findAll();
        
        return $this->render('departamentos/index.html.twig', [
            'departamentos' => $departamentos,
        ]);
    }

    #[Route('/departamentos/nuevo', name: 'departamentos_nuevo', methods: ['GET', 'POST'])]
    public function nuevo(Request $request): Response
    {
        $departamento = new Departamentos();
        $form = $this->createForm(DepartamentosType::class, $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($departamento);
            $entityManager->flush();

            return $this->redirectToRoute('departamentos_index');
        }

        return $this->render('departamentos/nuevo.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/departamentos/{id}', name: 'departamentos_detalle', methods: ['GET'])]
    public function detalle(Departamentos $departamento): Response
    {
        return $this->render('departamentos/detalle.html.twig', [
            'departamento' => $departamento,
        ]);
    }

    #[Route('/departamentos/{id}/editar', name: 'departamentos_editar', methods: ['GET', 'POST'])]
    public function editar(Request $request, Departamentos $departamento): Response
    {
        $form = $this->createForm(DepartamentosType::class, $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('departamentos_index');
        }

        return $this->render('departamentos/editar.html.twig', [
            'departamento' => $departamento,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/departamentos/{id}', name: 'departamentos_eliminar', methods: ['DELETE'])]
    public function eliminar(Request $request, Departamentos $departamento): Response
    {
        if ($this->isCsrfTokenValid('eliminar' . $departamento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($departamento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('departamentos_index');
    }
}
