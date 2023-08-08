<?php
namespace App\Controller\admin;

use App\Entity\Visite;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminVoyagesController
 *
 * @author clement
 */
class AdminVoyagesController extends AbstractController {

    const PAGE_ADMIN_VOYAGES = "admin/admin.voyages.html.twig";
    const ROUTE_ADMIN_VOYAGES = "admin.voyages";
    
    /**
     * 
     * @var VisiteRepository
     */
    private $repository;
    
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;
    }
    
    /**
     * @Route("/admin", name="admin.voyages")
     * @return Response
     */
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render(self::PAGE_ADMIN_VOYAGES, [
            'visites' => $visites
        ]);
    }
    
    /**
     * @Route("/admin/suppr/{id}", name="admin.voyage.suppr")
     * @param Visite $visite
     * @return Response
     */
    public function suppr($id, VisiteRepository $repository): Response{
        $visite = $repository->find($id);
        $this->repository->remove($visite, true);
        return $this->redirectToRoute(self::ROUTE_ADMIN_VOYAGES);
    }
    
    /**
     * @Route("/admin/edit/{id}", name="admin.voyage.edit")
     * @param Visite $visite
     * @param Request $request
     * @return Response
     */
    public function edit($id, VisiteRepository $repository): Response{
        $visite = $repository->find($id);
        return $this->render("admin/admin.voyage.edit.html.twig", [
            'visite' => $visite
        ]);
//        $formVisite = $this->createForm(VisiteType::class, $visite);
//
//        $formVisite->handleRequest($request);
//        if($formVisite->isSubmitted() && $formVisite->isValid()){
//            $this->repository->add($visite, true);
//            return $this->redirectToRoute(self::ROUTE_ADMIN_VOYAGES);
//        }     
//
//        return $this->render(self::PAGE_ADMIN_VOYAGE_EDIT, [
//            'visite' => $visite,
//            'formvisite' => $formVisite->createView()
//        ]);        
    }
    
   
    
}