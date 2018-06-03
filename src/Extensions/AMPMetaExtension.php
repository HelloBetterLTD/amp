<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 6/3/18
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Extensions;


use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataExtension;
use SilverStripers\AMP\Control\AMPDirector;

class AMPMetaExtension extends DataExtension
{

	public function MetaTags(&$tags)
	{
		if(AMPDirector::is_amp()) {
			$request = Controller::curr()->getRequest();
			$ampLink = Controller::join_links($request->getURL(), 'amp.html');
			$tags .= "<link rel='amphtml' href='$ampLink' /> \n";
		}
	}

}