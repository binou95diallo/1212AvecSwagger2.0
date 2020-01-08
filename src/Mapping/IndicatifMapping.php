<?php

namespace App\Mapping;
use Symfony\Component\HttpFoundation\JsonResponse;


class IndicatifMapping {
    protected $success = 'success';
    protected $message = 'message';
    protected $data = 'data';

    public function getIndicatif($indicatif) {
        return new JsonResponse([
            $this->success=>true,
            $this->data=>array(
                                'id' =>$indicatif->getId(),
                                'indicatif' =>$indicatif->getIndicatif(),
                                'pays'=>$indicatif->getPays())
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
    }
    
}   