<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles/new", name="articles_new")
     */
    public function new(): Response
    {
        return $this->render('articles/new.html.twig');
    }

    /**
     * @Route("/articles", methods={"GET"}, name="articles")
     */
    public function index(): Response
    {
        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
        ]);
    }


    /**
     * @Route("/articles/{id}", name="articles_show", requirements={"id"="\d+"})
     */ 
    public function show(int $id): Response
    {

        return $this->render('articles/show.html.twig', [
            'articleId' => $id
        ]);
    }

      /**
     * @Route("/articles/", methods={"POST"}, name="article_create")
     */ 
    public function create(Request $request)
    {
        dd($request);
    }

}
