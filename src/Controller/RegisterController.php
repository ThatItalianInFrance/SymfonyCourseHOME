<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class RegisterController extends AbstractController
{
    
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
    $this->passwordHasher = $passwordHasher;
    }
    #[Route('/inscription', name: 'register')]



    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        
        $user=new User();
        $form=$this->createForm(RegisterType::class, $user);

        $form ->handleRequest($request); 
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            ));
            $manager->persist($user); // previent doctrine que l'on veut sauver on persiste dans le temps
            $manager->flush(); // envoi la requête à la base de donnée
            }
           
        return $this->render('register/index.html.twig', [
            "form"=>$form->createView(),
            'controller_name' => 'RegisterController',
        ]);
    }
    
}
