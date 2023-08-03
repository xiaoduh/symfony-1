<?php


namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of VoyagesController
 *
 * @author Clément
 */
class VoyagesController extends AbstractController{
    
    /** @var VisiteRepository **/
    
    private $repository;
    
    /** @param VisiteRepository $repository **/
    
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;
    }
    
    /**
     * @route("/voyages/tri/{champ}/{ordre}", name="voyages.sort")
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    
    public function sort($champ, $ordre): Response{
        $visites = $this->repository->findallOrderBy($champ, $ordre);
        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
        ]);
    }
    
    /**
     * @route("/voyages", name="voyages")
     * @return Response
     */
    public function index(): Response {
        $visites = $this->repository->findallOrderBy('datecreation', 'DESC');
        return $this->render("pages/voyages.html.twig", ['visites' => $visites]);
}
}
