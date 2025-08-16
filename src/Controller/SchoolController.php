<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SchoolController extends AbstractController
{
    #[Route('/school', name: 'app_school')]
    public function index(): Response
    {
        return $this->render('school/index.html.twig', [
            'controller_name' => 'SchoolController',
        ]);
    }

    #[Route('/school/new', name: 'app_school_new')]
    public function new(): Response
    {
        
    }
}
