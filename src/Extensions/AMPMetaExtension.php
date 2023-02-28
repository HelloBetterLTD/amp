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
use SilverStripe\Control\Director;
use SilverStripe\ORM\DataExtension;
use SilverStripers\AMP\Control\AMPDirector;

class AMPMetaExtension extends DataExtension
{

	public function MetaTags(&$tags)
	{

        if(AMPDirector::is_amp_allowed($this->owner)) {
            $request = Controller::curr()->getRequest();
            $ampLink = Director::absoluteURL(Controller::join_links($request->getURL(), 'amp.html'));
            $tags .= "\n<link rel='amphtml' href='$ampLink' />";
            // $tags .= "\n<link rel='canonical' href='" . Director::absoluteURL($request->getURL()) . "' />";
        }

	}

}
