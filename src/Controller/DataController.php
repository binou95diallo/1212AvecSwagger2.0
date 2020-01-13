<?php

namespace App\Controller;

use App\Entity\ListeIndicatifs;
use App\Entity\Publicite;
use App\Form\PubliciteType;
use App\Mapping\EntrepriseMapping;
use App\Mapping\IndicatifMapping;
use App\Mapping\PubMapping;
use Doctrine\ORM\EntityManager;
use App\Mapping\PubliciteMapping;
use App\Repository\AgenceRepository;
use App\Repository\AssistantsRepository;
use App\Repository\ListeIndicatifsRepository;
use App\Repository\PubliciteRepository;
use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DataController extends AbstractController
{
    protected $success = 'success';
    protected $message = 'message';
    protected $data = 'data';
    protected $code='code';
    /**
     * @Rest\Post("/makePub", name="makePub")
     */
    public function makePub(Request $request,EntityManagerInterface $em)
    {
        $pub=new Publicite();
        $form = $this->createForm(PubliciteType::class, $pub);
        $form->handleRequest($request);
        $value=$request->request->all();
        $form->submit($value);
        if($form->isSubmitted()){
            $em->persist($pub);
            $em->flush();
            return new JsonResponse([$this->success=>true,$this->code=>201,$this->message=>'enregistrement d\'une publicite reussie' ]);
        }
    }

    /**
     * @Rest\Get("/pub", name="pub")
     */
    public function pub(Request $request,EntityManagerInterface $em,PubliciteRepository $publiciteRepository)
    {
        $pub=$publiciteRepository->findAll();
        $pubMapping=new PubMapping();
        return $pubMapping->getPublicite($pub);
    }

     /**
     * @Rest\Get("/listeAgences", name="listeAgences")
     */
    public function listeAgences(AgenceRepository $agenceRepository)
    {
        $listeAgence=$agenceRepository->findAll();
        $entrepriseMapping=new EntrepriseMapping();
        return $entrepriseMapping->getlisteAgences($listeAgence);
    }
    /**
    * @Rest\Get("/listeAssistants", name="listeAssistants")
    */
   public function listeNumerosAssistant(AssistantsRepository $assistantsRepository)
   {
       $listeAssistant=$assistantsRepository->findAll();
       $entrepriseMapping=new EntrepriseMapping();
       return $entrepriseMapping->getlisteNumeroAssistants($listeAssistant);
   }
   
    /**
     * @Rest\Post("/indicatifs", name="rechercheIndicatifs")
     */
    public function indicatifsPays(Request $request,ListeIndicatifsRepository $listeIndicatifsRepository){
        $value=$request->request->all();
        $pays=$value["pays"];
        if($pays!=null){
            $indicatif=$listeIndicatifsRepository->findOneBy(["pays"=>$pays]);
            if($indicatif==null){
                return new JsonResponse([$this->success=>false,$this->code=>105,$this->message=>'nom de pays non existant' ]);
            }
            $indicatifsMapping=new IndicatifMapping();
            return $indicatifsMapping->getIndicatif($indicatif);
        }else{
            $indicatifs=$listeIndicatifsRepository->findAll();
            $indicatifsMapping=new IndicatifMapping();
            return $indicatifsMapping->getlisteIndicatifs($indicatifs);
        }
    }
}
