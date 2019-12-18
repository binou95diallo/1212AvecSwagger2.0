<?php

namespace App\Mapping;
use Symfony\Component\HttpFoundation\JsonResponse;


class SearchMapping {

    public function listeEntreprise($entreprises) {

        $liste_entreprises = array();
        $domaines = array();
        if($entreprises){
            foreach ($entreprises as $entreprise){        
                $liste_domaines = $entreprise->getDomaine();
                foreach ($liste_domaines as  $liste_domaine){
                    $domaines[] = $liste_domaine->getNom();
                }

                $liste_entreprises[] = array('id'=>$entreprise->getId(),
                                             'nom'=>$entreprise->getNom(),
                                             'logo'=>$entreprise->getLogo(),
                                             'domaine'=>$domaines,
                                             'fixe'=>$entreprise->getFixe(),
                                             'region'=>$entreprise->getLocalite()->getLibelle(),);
            }
        return new JsonResponse([
                    'success'=>true,
                    'data' =>  $liste_entreprises ,
                    ]);
        }
        return new JsonResponse([
            'success'=>false,
            'message' =>  'Aucune entreprise trouvée',
            ]);
       }
}   