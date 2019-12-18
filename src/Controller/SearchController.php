<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Entity\Entreprise;
use App\Entity\Localite;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Mapping\SearchMapping;

class SearchController extends FOSRestController implements ClassResourceInterface
{
  /**
     * @Rest\Post("/recherche")
     * @return JsonResponse
     */
    public function searchEntreprise(Request $request) {
        $data=$request->request->all();
        $nom = $data['nom'];
        $region = $data['region'];      
        $domaine = $data['domaine'];    
        $liste_entreprise = $this->getDoctrine()->getRepository(Entreprise::class)->search($nom,$region,$domaine);
        $searchMapping = new SearchMapping();
        return $searchMapping->listeEntreprise( $liste_entreprise);
    }
}
