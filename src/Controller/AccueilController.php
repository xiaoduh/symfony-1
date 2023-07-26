<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author Clément
 */


class AccueilController {
    
    /**
     * @route("/", name="accueil")
     * @return Response
     */
    public function index(): Response {
        return new Response('Hello Wolrd from PHP!');
    }
}
