<?php
namespace App\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Parameter(
 *              name="id",
 *              in="path",
 *              description="ID du concours",
 *              required=true,
 *              @OA\Schema(type="integer")
 * ),
 * @OA\Parameter(
 *              name="username",
 *              in="query",
 *              description="nom d'utilisateur",
 *              required=true,
 *              @OA\Schema(type="string")
 * ),
 * @OA\Parameter(
 *              name="password",
 *              in="query",
 *              description="mot de pass utilisateur",
 *              required=true,
 *              @OA\Schema(type="string")
 * ),
 * @OA\Response(
 *              response="Not found",
 *              description="la ressource n'existe pas",
 *              @OA\JsonContent(
 *                          @OA\Property(property="message",type="string",example="article not found")     
 * ) 
 * ),
 * @OA\SecurityScheme(bearerFormat="JWT",type="http",securityScheme="bearerAuth",scheme="bearer")
 */

 class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController{
    
 }

?>