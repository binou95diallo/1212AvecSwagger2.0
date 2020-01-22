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
Use Swagger\Annotations as SWG;

class EntrepriseController extends AbstractFOSRestController implements ClassResourceInterface
{

     /**
     * @Rest\Post("/infos_entreprise")
     * @QMLogger(message="Details entreprise")
     * @SWG\Post(
        *path="/infos_entreprise",
        *consumes={"multipart/form-data"},
        *parameters={
            *@Swg\Parameter(name="id", in="formData", description="Id de l'entreprise", type="string"),
        *},
        *@Swg\Response(
        *   response="200",
        *   description="Details entreprise",
        *   schema=@Swg\Schema(type="object",ref="#/definitions/default")
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
     * @SWG\Get(
        *path="/liste_regions_domaines",
        *@Swg\Response(
        *   response="200",
        *   description="liste des regions et domaines",
        *   schema=@Swg\Schema(type="object",ref="#/definitions/default")
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

