<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classroom;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Classroom::class);
        $classrooms=$repo->findAll();
        var_dump($classrooms);
        die();
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    public function addStudent(Request $req)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class,$student);
        $form->handleRequest($req);
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
        return $this->redirectToRoute('app_student');
        }

    }
    #[Route('/deleteStudent/{id}',name:'student_delete')]
    public function deleteStudent($id,StudentRepository $repo){
       $student =$repo -> find($id);
       $em =$doctrine ->getManager();
       $em -> remove($student);
       $em -> flush();
       $this -> redirectToRoute('app_student');
    }
    #[Route('/updateStudent/{id}',name:'student_update')]
    public function updateStudent($id,StudentRepository $repo){
       $student =$repo -> find($id);
        $student -> setName(' Student updated');
        $em =$doctrine ->getManager();
        $em->flush();
         return $this -> redirectToRoute('app_student');
      
}
}
