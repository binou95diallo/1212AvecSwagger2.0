<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use OpenApi\Annotations as OA;

/**
 * @OA\schema(
 *      schema="Assistants",
 *      description="numeros assistants",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string",property="numero")
 * ),
 * @OA\schema(
 *      schema="Agences",
 *      description="Liste des agences",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string",property="nom"),
 *      @OA\Property(type="string",property="adresse"),
 *      @OA\Property(type="string",property="localite"),
 *      @OA\Property(type="string",property="latittude"),
 *      @OA\Property(type="string",property="longitude"),
 *      @OA\Property(type="string",property="fixe")
 * ),
 * @OA\schema(
 *      schema="Pubs",
 *      description="Liste des publicites",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string",property="urlImage"),
 *      @OA\Property(type="string",property="urlSiteWeb"),
 *      @OA\Property(type="string",property="description"),
 *      @OA\Property(type="string",property="type")
 * ),
 * @OA\schema(
 *      schema="RegionDomaine",
 *      description="Liste des publicites",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string",property="nom")
 * ),
 * @OA\schema(
 *      schema="InputInfosEnt",
 *      description="saisi de l'id de l'entreprise",
 *      @OA\Property(type="integer", property="id")
 * ),
 * @OA\schema(
 *      schema="InfosEntreprise",
 *      description="details entreprise",
 *      @OA\Property(type="integer",property="id"),
 *      @OA\Property(type="string",property="nom"),
 *      @OA\Property(type="string",property="adresse"),
 *      @OA\Property(type="string",property="fixe"),
 *      @OA\Property(type="string",property="logo"),
 *      @OA\Property(type="string",property="mobile"),
 *      @OA\Property(type="string",property="fax"),
 *      @OA\Property(type="string",property="email"),
 *      @OA\Property(type="string",property="web"),
 *      @OA\Property(type="string",property="instagram"),
 *      @OA\Property(type="string",property="facebook"),
 *      @OA\Property(type="string",property="twitter"),
 *      @OA\Property(type="string",property="latitude"),
 *      @OA\Property(type="string",property="longitude"),
 *      @OA\Property(type="string",property="boitepostale"),
 *      @OA\Property(type="string",property="quartier"),
 *      @OA\Property(type="string",property="rue"),
 *      @OA\Property(type="object",property="horaires"),
 *      @OA\Property(type="object",property="agences"),
 *      @OA\Property(type="object",property="domaine"),
 *      @OA\Property(type="object",property="parcnumero"),
 *      @OA\Property(type="string",property="region"),
 *      @OA\Property(type="string",property="commune")
 * ),
 * @OA\schema(
 *      schema="InputPub",
 *      description="ajout publicite",
 *      @OA\Property(type="string", property="urlImage"),
 *      @OA\Property(type="string", property="urlWebsite"),
 *      @OA\Property(type="string", property="description"),
 *      @OA\Property(type="string", property="type")
 * ),
 * @OA\schema(
 *      schema="Publicite",
 *      description="Output publicite",
 *      @OA\Property(type="boolean", property="sucess"),
 *      @OA\Property(type="integer", property="code"),
 *      @OA\Property(type="string", property="message")
 * ),
 * @OA\schema(
 *      schema="InputIndicatif",
 *      description="input indicatif",
 *      @OA\Property(type="string",property="pays")
 * ),
 * @OA\schema(
 *      schema="Indicatifs",
 *      description="Indicatif pays",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", property="pays"),
 *      @OA\Property(type="string", property="indicatif")
 * ),
 * @OA\schema(
 *      schema="InputSearch",
 *      description="Recherche",
 *      @OA\Property(type="string", property="nom"),
 *      @OA\Property(type="string", property="region"),
 *      @OA\Property(type="string", property="domaine")
 * ),
 * @OA\schema(
 *      schema="Recherche",
 *      description="Recherche entreprise",
 *      @OA\Property(type="integer",property="id"),
 *      @OA\Property(type="string",property="nom"),
 *      @OA\Property(type="string",property="adresse"),
 *      @OA\Property(type="string",property="fixe"),
 *      @OA\Property(type="string",property="logo"),
 *      @OA\Property(type="object",property="domaine"),
 *      @OA\Property(type="string",property="region")
 * )
 */

class Annuaire1212Normalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, $format = null, array $context = array()): array
    {

        // Here: add, edit, or delete some data

        return $this->normalizer->normalize($object, $format, $context);
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof \App\Entity\Entreprise;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
