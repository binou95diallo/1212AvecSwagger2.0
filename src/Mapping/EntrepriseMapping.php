<?php

namespace App\Mapping;
use Symfony\Component\HttpFoundation\JsonResponse;


class EntrepriseMapping {
    protected $success = 'success';
    protected $message = 'message';
    protected $data = 'data';
    protected $code='code';

    public function getlisteDomaines($domaines_entreprise) {
        $domaines = array();
        if($domaines_entreprise){
            foreach ($domaines_entreprise as  $domaine_entreprise){
                $domaines[] = array('id'=>$domaine_entreprise->getId(),
                                    'nom'=>$domaine_entreprise->getNom());
            }
            return $domaines;
        }
        return new JsonResponse([
            'success'=>false,
            'code'=>107,
            'message' =>  'Aucun domaine trouvé',
            ]);
    }
    public function getlisteParcsFixe($parcsnumeros) {
        $liste_numeros = array();
        if($parcsnumeros){
            foreach ($parcsnumeros as $parcs){
                $liste_numeros[] = array('id'=>$parcs->getId(),
                                         'nom'=>$parcs->getLibelle(),
                                         'numero'=>$parcs->getNumero());
            }
            return $liste_numeros;
        }
        return new JsonResponse([
            'success'=>false,
            'code'=>108,
            'message' =>  'Aucun parc fixe trouvé',
            ]);
    }
    public function getlisteAgences($agences_entreprise){
        $agences = array();
        if($agences_entreprise){
            foreach ($agences_entreprise as  $agence_entreprise){
                $agences[] = array('id'=>$agence_entreprise->getId(),
                                   'nom'=> $agence_entreprise->getNom(),
                                   'adresse'=>$agence_entreprise->getAdresse(),
                                   'localite'=>$agence_entreprise->getEntreprise()->getLocalite()->getLibelle(),
                                   'latittude'=>$agence_entreprise->getEntreprise()->getLatitude(),
                                   'longitude'=>$agence_entreprise->getEntreprise()->getLongitude(),
                                   'fixe'=>$agence_entreprise->getFixe());
            }
            return new JsonResponse([$this->success=>true,
                                    $this->data=$agences]);
        } return new JsonResponse([
            'success'=>false,
            'code'=>102,
            'message' =>  'Aucune agence trouvée',
            ]);
    }
    public function getlisteNumeroAssistants($numeroAssistants){
        $assistants = array();
        if(isset($numeroAssistants) && is_array($numeroAssistants)){
            foreach ($numeroAssistants as  $numero){
                $assistants[] = array('id'=>$numero->getId(),
                                      'numero'=> $numero->getNumero(),
                                      'libelle'=>$numero->getLibelle()
                                     );
            }
            
        return new JsonResponse([$this->success=>true,
        $this->data=$assistants]);
        }
        return new JsonResponse([
            'success'=>false,
            'code'=>103,
            'message' =>  'Pas de numéros de service d\'assistances trouvé',
            ]);
    }
    public function getlisteHoraires($horaires_entreprise) {
        $horaires = array();
        if($horaires_entreprise){
            foreach($horaires_entreprise as $horaire){
                $horaires[] = array('heureOuverture'=>$horaire->getHeureOuverture(),
                                    'heureFermeture'=>$horaire->getHeureFermeture(),
                                    'jour'=>$horaire->getJour());
            }
            return $horaires;
        }
        return new JsonResponse([
            'success'=>false,
            'code'=>104,
            'message' =>  'Pas de liste d\'horaire pour cette entreprise',
            ]);
    }
    public function getlisteRegion($regions) {
        $liste_regions = array();
        if($regions){
            foreach ($regions as $region){
                $liste_regions[] =array('id'=> $region->getId(),
                                         'nom'=> $region->getLibelle());
            }
            return  $liste_regions;
        }
        return new JsonResponse([
            'success'=>false,
            'code'=>105,
            'message' =>  'Aucune region disponible',
            ]);
    }
 
    public function infosEntreprise($entreprise) {
        if($entreprise == null){
            return new JsonResponse([
                $this->success=>false,
                $this->code=>106,
                $this->message=>'Entreprise non trouvée']);
        }
        $region = null;
        $commune = null;
        $horaires_entreprise = $entreprise->getHoraire();
        $agences_entreprise = $entreprise->getAgences();
        $domaines_entreprise = $entreprise->getDomaine();
        $localite_entreprise = $entreprise->getLocalite();
        $parcsnumeros = $entreprise->getParcFixe();
        if($localite_entreprise){
            $type_localite = $localite_entreprise->getTypeLocalite()->getId();
            if($type_localite == 1){
                $region = $localite_entreprise->getLibelle();
            }elseif($type_localite == 2){
                $region = $localite_entreprise->getParent()->getLibelle();
                $commune = $localite_entreprise->getLibelle();
            }
        }
        return new JsonResponse([
                                $this->success=>true,
                                $this->data=>array(
                                                    'id' =>$entreprise->getId(),
                                                    'nom' =>$entreprise->getNom(),
                                                    'logo'=>$entreprise->getLogo(),
                                                    'adresse' => $entreprise->getAdresse(),
                                                    'fixe'=> $entreprise->getFixe(),
                                                    'mobile' => $entreprise->getMobile(),
                                                    'fax' =>$entreprise->getFax(),
                                                    'email' =>$entreprise->getEmail(),
                                                    'web' =>$entreprise->getSiteWeb(),
                                                    'instagram' =>$entreprise->getInstagram(),
                                                    'facebook' =>$entreprise->getFacebook(),
                                                    'twitter' =>$entreprise->getTwitter(),
                                                    'latitude' =>$entreprise->getLatitude(),
                                                    'longitude' =>$entreprise->getLongitude(),
                                                    'boitepostale' =>$entreprise->getBoitePostale(),
                                                    'quartier' =>$entreprise->getQuartier(),
                                                    'rue' =>$entreprise->getRue(),
                                                    'horaires'=>$this->getlisteHoraires($horaires_entreprise),
                                                    'agences' =>$this->getlisteAgences($agences_entreprise),
                                                    'parcnumero'=>$this->getlisteParcsFixe($parcsnumeros),
                                                    'domaine'=>$this->getlisteDomaines($domaines_entreprise),
                                                    'region' =>$region,
                                                    'commune' =>$commune)
                                ]);
    }
    public function liste($domaines,$regions) {
        return new JsonResponse([
            $this->success=>true,
            $this->data=>array(
                    'region' =>$this->getlisteRegion($regions),
                    'domaine' =>$this->getlisteDomaines($domaines))
            ]);
        
    }
}   