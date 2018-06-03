<?php

/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 6/3/18
 * Time: 11:43 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\View;

use SilverStripe\View\TemplateGlobalProvider;
use SilverStripers\AMP\Control\AMPDirector;

class AMPView  implements TemplateGlobalProvider
{

	public static function get_template_global_variables()
	{
		return [
			'IsAMP',
		];
	}

	public static function IsAMP()
	{
		return AMPDirector::is_amp();
	}

}