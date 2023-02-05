<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    #[Route('/teacher/{name}')]
    public function showTeacher($name)
    {
        return new Response("Bonjour ".$name); 
    }

    public function goToIndex()
{
    return $this->redirectToRoute('student_index');
}
}
