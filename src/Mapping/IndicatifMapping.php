<?php

namespace App\Mapping;
use Symfony\Component\HttpFoundation\JsonResponse;


class IndicatifMapping {
    protected $success = 'success';
    protected $message = 'message';
    protected $data = 'data';
    protected $code='code';

    public function getIndicatif($indicatif) {
        if($indicatif){
            return new JsonResponse([
                $this->success=>true,
                $this->data=>array(
                                    'id' =>$indicatif->getId(),
                                    'indicatif' =>$indicatif->getIndicatifs(),
                                    'pays'=>$indicatif->getPays())
                ]);
        }

        return new JsonResponse([
            $this->success=>false,
            $this->code=>109,
            $this->data=>"Indicatif non trouvé"
            ]);
    }

    public function getlisteIndicatifs($listeIndicatifs){
        $listeIndicatif = array();
        if(isset($listeIndicatifs) && is_array($listeIndicatifs)){
            foreach ($listeIndicatifs as  $indicatif){
                $listeIndicatif[] = array('id'=>$indicatif->getId(),
                                      'indicatif' =>$indicatif->getIndicatif(),
                                       'pays'=>$indicatif->getPays()
                                     );
            }
        return new JsonResponse([$this->success=>true,
        $this->data=$listeIndicatif]);
        }
        return new JsonResponse([
            $this->success=>false,
            $this->code=>110,
            $this->data=>"Il n\'y a pas d\'indicatif dans la table"
            ]);
    }
    
}   