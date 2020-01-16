<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Entity\Localite;
use App\Entity\Entreprise;
use App\Entity\TypeLocalite;
use Psr\Log\LoggerInterface;
use App\Mapping\EntrepriseMapping;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
Use App\Annotation\QMLogger;
Use OpenApi\Annotations as OA;

class EntrepriseController extends AbstractFOSRestController implements ClassResourceInterface
{

     /**
     * @Rest\Post("/infos_entreprise")
     * @QMLogger(message="Details entreprise")
     * @OA\Post(
        *path="/infos_entreprise",
        *@OA\RequestBody(
            *@OA\JsonContent(ref="#components/schemas/InputInfosEnt"),
        *),
        *@OA\Response(
        *   response="200",
        *   description="Details entreprise",
        *   @OA\JsonContent(ref="#/components/schemas/InfosEntreprise")
        *)
     *)
     * @return JsonResponse
     */
    public function detailsEntreprise(Request $request) {
        $id = $request->request->get('id');
        $entreprise = $this->getDoctrine()->getRepository(Entreprise::class)->find($id);
        $entrepriseMapping = new EntrepriseMapping();
        return  $entrepriseMapping->infosEntreprise($entreprise);
    }
    /**
     * @Rest\Get("/liste_regions_domaines")
     * @QMLogger(message="Liste des regions et domaines")
     * @OA\Get(
        *path="/liste_regions_domaines",
        *@OA\Response(
        *   response="200",
        *   description="liste des regions et domaines",
        *   @OA\JsonContent(ref="#/components/schemas/RegionDomaine")
        *)
     *)
     * @return JsonResponse
     */
    public function filtres(Request $request) {
        $type_localite = $this->getDoctrine()->getRepository(TypeLocalite::class)->find(1);
        $domaines = $this->getDoctrine()->getRepository(Domaine::class)->findAll();
        $regions = $this->getDoctrine()->getRepository(Localite::class)->findBy(['type_localite'=>$type_localite]);
        $entrepriseMapping = new EntrepriseMapping();
        return  $entrepriseMapping->liste($domaines,$regions);
    }   
   
}

