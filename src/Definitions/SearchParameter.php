<?php
namespace App\Definitions;

use Swagger\Annotations as Swg;

/**
 * @Swg\Definition(definition="search")
 */
class SearchParameter {
	
	
	/**
	 * Nom entreprise
	 * @var string
	 * @Swg\Property(type="string", description="nom entreprise")
	 */
	public $nom;
	
	/**
	 * Region
	 * @var string
	 * @Swg\Property(type="string", description="region name", default=200)
	 */
	public $region;
	
	/**
	 * The domaine
	 * @var string
	 * @Swg\Property(type="string")
	 */
    public $domaine;
}