<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ClassroomRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;

final class HomeController extends AbstractController
{
    public function __construct(
        StudentRepository $studentRepo,
        TeacherRepository $teacherRepo,
        ClassroomRepository $classroomRepo
    ) {
        $this->studentRepo = $studentRepo;
        $this->teacherRepo = $teacherRepo;
        $this->classroomRepo = $classroomRepo;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        $roles = $user->getRoles();   
        $data = [];
        if(in_array('ROLE_ADMIN', $roles))
        {
            $data['StudentsCount'] = $this->studentRepo->count([]);
            $data['TeachersCount'] = $this->teacherRepo->count([]);
            $data['ClassesCount'] = $this->classroomRepo->count([]);
        }
        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }
}
