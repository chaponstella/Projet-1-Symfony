<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class PagesController {
    public function about() : Response
    {
return new Response("Page ABOUT !");
    }
}