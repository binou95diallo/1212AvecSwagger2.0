<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Mapping\EntrepriseMapping;
use App\Entity\Entreprise;
use App\Entity\Domaine;
use App\Entity\Localite;
use App\Entity\TypeLocalite;

class EntrepriseController extends FOSRestController implements ClassResourceInterface
{
     /**
     * @Rest\Post("/infos_entreprise")
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

