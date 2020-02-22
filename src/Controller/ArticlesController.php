<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles/new", name="articles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article;
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid() ) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Votre article est enregistré!'
            );

            return $this->redirectToRoute('articles');

    }


        return $this->render('articles/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/articles", methods={"GET"}, name="articles")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles
        ]);
    }


    /**
     * @Route("/articles/{article}", name="articles_show", requirements={"article"="\d+"})
     */ 
    public function show(Article $article): Response
    {

        return $this->render('articles/show.html.twig', [
            'article' => $article
        ]);
    }


    /**
     * @Route("/articles/search", methods={"GET"}, name="article_search")
     */ 

    public function search(Request $request, ArticleRepository $articleRepository){

        $searchTerm = $request->query->get('search');

        if ($searchTerm == ''){
            $articles = $articleRepository->findAll();
        }
        else {
            $articles = $articleRepository->findByAllField($searchTerm);
    
        }

    return $this->render('articles/index.html.twig', [
    'articles' => $articles
]);

}

}
