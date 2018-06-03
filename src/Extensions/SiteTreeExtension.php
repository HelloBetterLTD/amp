<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 6/3/18
 * Time: 1:08 PM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Extensions;


use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataExtension;
use SilverStripers\AMP\Control\AMPDirector;

class SiteTreeExtension extends DataExtension
{

	public function updateLink(&$link, $action, $relativeLink)
	{
		if(AMPDirector::is_amp()) {
			$link = Controller::join_links($link, 'amp.html');
		}
	}

}