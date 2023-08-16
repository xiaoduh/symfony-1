<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;

use App\Entity\Environnement;
use App\Repository\EnvironnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminEnvironnementController
 *
 * @author Clément
 */
class AdminEnvironnementController extends AbstractController {

    /**
     * 
     * @var EnvironnementRepository
     */
    private $repository;
    
    /**
     * 
     * @param EnvironnementRepository $repository
     */
    public function __construct(EnvironnementRepository $repository) {
        $this->repository = $repository;
    }
    
    /**
     * @Route("/admin/environnements", name="admin.environnements")
     * @return Response
     */
    public function index(): Response{
        $environnements = $this->repository->findAll();
        return $this->render("admin\admin.environnements.html.twig", [
            'environnements' => $environnements
        ]);
    }
    
    /**
     * @Route("/admin/environnements/suppr/{id}", name="admin.environnements.suppr")
     * @param Int $id id of environnement to delete
     * @return Response
     */
    public function suppr($id, EnvironnementRepository $repository): Response{
        $environnement = $repository->find($id);
        $this->repository->remove($environnement, true);
        return $this->redirectToRoute('admin.voyages');
    }
    
         /**
     * @Route("/admin/environnements/ajout", name="admin.environnements.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request): Response{
        $nomEnv = $request->get("nom");
        $env = new Environnement();
        $env->setNom($nomEnv);
        $this->repository->add($env, true);
        return $this->redirecttoRoute('admin.environnements');       
    }
}
