<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 6/3/18
 * Time: 10:54 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Extensions;


use SilverStripe\Core\Extension;

class AMPControllerExtension extends Extension
{

	private static $allowed_actions = [
		'amp'
	];


	public function amp()
	{
		return $this->owner;
	}

}