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
use SilverStripe\Control\Director;
use SilverStripe\ORM\DataExtension;
use SilverStripers\AMP\Control\AMPCache;
use SilverStripers\AMP\Control\AMPDirector;

class SiteTreeExtension extends DataExtension
{

	public function updateLink(&$link, $action, $relativeLink)
	{
		if(AMPDirector::is_amp() && AMPDirector::is_amp_allowed($this->owner)) {
			$link = Controller::join_links($link, 'amp.html');
		}
	}

	public function APMLink($action = '')
    {
        if(AMPDirector::is_amp_allowed($this->owner)) {
            return Controller::join_links($this->owner->Link($action), 'amp.html');
        }
    }

	public function APMAbsoluteLink($action = '')
    {
        if(AMPDirector::is_amp_allowed($this->owner)) {
            return Controller::join_links($this->owner->AbsoluteLink($action), 'amp.html');
        }
    }


    public function clearAmpCaches()
    {
        $cache = AMPCache::create();
        return $cache->purge($this->APMAbsoluteLink());
    }


}
