<?php

namespace App\Mapping;
use Symfony\Component\HttpFoundation\JsonResponse;


class PubMapping {
    protected $success = 'success';
    protected $message = 'message';
    protected $data = 'data';

    public function getPublicite($pub) {
       if($pub){
        return new JsonResponse([
            $this->success=>true,
            $this->data=>array(
                                'id' =>$pub->getId(),
                                'urlImage' =>$pub->getUrlImage(),
                                'urlSiteWeb'=>$pub->getUrlWebsite()),
                                'description'=>$pub->getDescription()
            ]);
       }
       return new JsonResponse([
        $this->success=>false,
        $this->code=>111,
        $this->data=>"Pub non trouvé"
        ]);
    }
    
}   