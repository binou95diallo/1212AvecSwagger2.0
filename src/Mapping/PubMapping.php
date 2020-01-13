<?php

namespace App\Mapping;
use Symfony\Component\HttpFoundation\JsonResponse;


class PubMapping {
    protected $success = 'success';
    protected $message = 'message';
    protected $data = 'data';

    public function getPublicite($pubs) {
       if($pubs){
           $listes_pub=array();
           foreach($pubs as $pub){
                $listes_pub[]=array(
                    'id' =>$pub->getId(),
                    'urlImage' =>$pub->getUrlImage(),
                    'urlSiteWeb'=>$pub->getUrlWebsite(),
                    'description'=>$pub->getDescription(),
                    'type'=>$pub->getType());
           }
        return new JsonResponse([
            $this->success=>true,
            $this->data=>$listes_pub]);
       }
       return new JsonResponse([
        $this->success=>false,
        $this->code=>111,
        $this->data=>"Pub non trouvé"
        ]);
    }
    
}   