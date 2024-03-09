<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Profesores;
use App\Entity\Departamentos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        // Obtener todos los profesores y departamentos desde la base de datos
        $profesores = $this->getDoctrine()->getRepository(Profesores::class)->findAll();
        $departamentos = $this->getDoctrine()->getRepository(Departamentos::class)->findAll();
        
        return $this->render('homepage/index.html.twig', [
            'profesores' => $profesores,
            'departamentos' => $departamentos,
        ]);
    }
}
