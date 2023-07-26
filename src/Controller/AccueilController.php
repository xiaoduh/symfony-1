<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AccueilController
 *
 * @author Clément
 */


class AccueilController extends AbstractController {
    
    /**
     * @route("/", name="accueil")
     * @return Response
     */
    public function index(): Response {
        return $this->render("pages/acceuil.html.twig");
}
}
