<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PagesController extends AbstractController{
    public function about() : Response
    {
return new Response("Page ABOUT !");
    }


    /**
     * @Route("/", methods={"GET"}, name="page_index")
     */
    public function index(){

        return $this->render('pages/index.html.twig');
    }
}