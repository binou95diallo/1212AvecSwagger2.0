<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Entity\Localite;
use App\Entity\Entreprise;
use App\Mapping\SearchMapping;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
Use App\Annotation\QMLogger;
Use Swagger\Annotations as Swg;

class SearchController extends AbstractFOSRestController implements ClassResourceInterface
{
  /**
     * @Rest\Post("/recherche")
     * @QMLogger(message="recherche entreprise")
     * @SWG\Post(
        *path="/recherche",
        *parameters={
             *@Swg\Parameter(in="body",name="recherche",description="parametre de recherche",
        * schema=@Swg\Schema(type="object",
        * ref="#/definitions/search")
        *)
        *},
        *@SWG\Response(
        *   response="200",
        *   description="recherche entreprise",
        *   schema=@Swg\Schema(type="object",ref="#/definitions/default")
        *)
    *)
     * @return JsonResponse
     */
    public function searchEntreprise(Request $request,EntrepriseRepository $entrepriseRepository) {
        $data=$request->request->all();
        $nom = $data['nom'];
        $region = $data['region'];      
        $domaine = $data['domaine'];    
        $liste_entreprise = $entrepriseRepository->search($nom,$region,$domaine);
        $searchMapping = new SearchMapping();
        return $searchMapping->listeEntreprise( $liste_entreprise);
    }
}
