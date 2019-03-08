<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 6/3/18
 * Time: 10:54 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Extensions;


use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Core\Extension;

class AMPControllerExtension extends Extension
{

	private static $allowed_actions = [
		'amp'
	];

	public function onAfterInit()
    {
        /* @var $controller Controller */
        $controller = $this->owner;
        if(is_a($controller, ContentController::class)) {
            $request = $controller->getRequest();
            $controller->getRequest()->setRouteParams(array_merge(
                $request->routeParams() ? : [],
                [
                    'AMPSPage' => get_class(Director::get_current_page())
                ]
            ));
        }
    }

	public function amp()
	{
		return $this->owner;
	}

}
