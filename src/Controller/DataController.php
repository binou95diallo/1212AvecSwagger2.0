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
Use App\Annotation\QMLogger;
use App\Repository\LocaliteRepository;
Use Swagger\Annotations as SWG;

class DataController extends AbstractController
{
    protected $success = 'success';
    protected $message = 'message';
    protected $data = 'data';
    protected $code='code';
    /**
     * @Rest\Post("/makePub", name="makePub")
     * @QMLogger(message="Ajouter une publicite")
     * @SWG\Post(
        *path="/makePub",
        *parameters={
        *@Swg\Parameter(in="body",name="addPub",description="parametre ajout pub",
        * schema=@Swg\Schema(type="object",
        * ref="#/definitions/addPub")
        *)
        *},
        *@SWG\Response(
        *   response="200",
        *   description="ajout pub",
        *   schema=@Swg\Schema(type="object",
        *   ref="#/definitions/default")
        *)
    *)
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
     * @QMLogger(message="Liste des publicites")
     * @SWG\Get(
        *path="/pub",
        *@SWG\Response(
        *   response="200",
        *   description="liste des publicites",
        *   schema=@Swg\Schema(type="object",
        *   ref="#/definitions/default")
        *)
     *)
     */
    public function pub(Request $request,EntityManagerInterface $em,PubliciteRepository $publiciteRepository)
    {
        $pub=$publiciteRepository->findAll();
        $pubMapping=new PubMapping();
        return $pubMapping->getPublicite($pub);
    }

     /**
     * @Rest\Get("/listeAgences", name="listeAgences")
     * @QMLogger(message="Liste des agences")
     * @SWG\Get(
        *path="/listeAgences",
        *@SWG\Response(
        *   response="200",
        *   description="liste des agences",
        *   schema=@Swg\Schema(type="object",
        *   ref="#/definitions/default")
        *)
     *)
     */
    public function listeAgences(AgenceRepository $agenceRepository)
    {
        $listeAgence=$agenceRepository->findAll();
        $nombreEntreprise=$agenceRepository->countEntreprise();
        $entrepriseMapping=new EntrepriseMapping();
        return $entrepriseMapping->getlisteAgences($listeAgence,$nombreEntreprise);
    }
    /**
    * @Rest\Get("/listeAssistants", name="listeAssistants")
    * @QMLogger(message="Liste des numeros services assistances")
    * @SWG\Get(
        *path="/listeAssistants",
        *@SWG\Response(
        *   response="200",
        *   description="liste numeros assistants",
        *   schema=@Swg\Schema(type="object",
        *   ref="#/definitions/default")
        *)
    *)
    */
   public function listeNumerosAssistant(AssistantsRepository $assistantsRepository)
   {
       $listeAssistant=$assistantsRepository->findAll();
       $entrepriseMapping=new EntrepriseMapping();
       return $entrepriseMapping->getlisteNumeroAssistants($listeAssistant);
   }
   
    /**
     * @Rest\Post("/indicatifs", name="rechercheIndicatifs")
     * @QMLogger(message="Indicatifs des pays")
     * @SWG\Post(
        *path="/indicatifs",
        *consumes={"multipart/form-data"},
        *parameters={
        *@Swg\Parameter(name="pays", in="formData", description="Nom du pays", type="string")
        *},
        *@SWG\Response(
        *   response="200",
        *   description="liste indicatifs",
        *   schema=@Swg\Schema(type="object",
        *   ref="#/definitions/default")
        *)
    *)
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

     /**
     * @Rest\Post("/entrepriseByRegions", name="entrepriseByRegions")
     * @QMLogger(message="Liste des entreprises par region")
     * @SWG\Post(
        *path="/entrepriseByRegions",
        *consumes={"multipart/form-data"},
        *parameters={
        *@Swg\Parameter(name="idRegion", in="formData", description="Id de la region", type="integer")
        *},
        *@SWG\Response(
        *   response="200",
        *   description="liste des entreprises par region",
        *   schema=@Swg\Schema(type="object",
        *   ref="#/definitions/default")
        *)
    *)
     */
    public function getEntrepriseByRegion(Request $request,LocaliteRepository $localiteRepository){
        $value=$request->request->all();
        $region=$localiteRepository->find($value["idRegion"]);
        $entreprises=$region->getEntreprises();
        if($entreprises!=null){
            $listeEntreprises=array();
            $entrepriseMapping=new EntrepriseMapping();
            foreach ($entrepriseMapping as $entreprise) {
                $listeEntreprises[]=$entrepriseMapping->listeEntrepriseByRegion($entreprise);
            }
        }

    }
}
