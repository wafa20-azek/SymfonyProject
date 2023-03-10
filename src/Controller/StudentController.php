<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/welcome')]
    public function index(){
        return new Response("Bonjour mes étudiants");
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
