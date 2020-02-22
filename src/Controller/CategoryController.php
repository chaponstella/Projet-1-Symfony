<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", methods={"GET"}, name="category_index")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/categories/new", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorie = new Category;
        $form = $this->createForm(CategoryType::class, $categorie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($categorie);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Votre categorie est enregistré!'
            );

            return $this->redirectToRoute('categories');

    }   

        return $this->render('category/new.html.twig', [
            'form' => $form->createView()
        ]); 
    }

    
    /**
     * @Route("/categories/{categorie}", name="category_show", requirements={"categorie"="\d+"})
     */ 
    public function show(Category $categorie): Response
    {

        return $this->render('category/show.html.twig', [
            'categorie' => $categorie
        ]);
    }

}
