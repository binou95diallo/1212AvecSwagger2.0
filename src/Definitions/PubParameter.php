<?php
namespace App\Definitions;

use Swagger\Annotations as Swg;

/**
 * @Swg\Definition(definition="addPub")
 */
class PubParameter {
	
	
	/**
	 * The website url
	 * @var string
	 * @Swg\Property(type="string", description="state request")
	 */
	public $urlWebsite;
	
	/**
	 * The image url
	 * @var string
	 * @Swg\Property(type="string", description="state request", default=200)
	 */
	public $urlImage;
	
	/**
	 * The description
	 * @var string
	 * @Swg\Property(type="string")
	 */
    public $description;
    
    /**
     * The type of the pub
     * @var string
     * @Swg\Property(type="string")
     */
    public $type;
}