<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 6/3/18
 * Time: 10:56 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Middleware;


use Lullabot\AMP\AMP;
use Lullabot\AMP\Validate\Scope;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\Middleware\HTTPMiddleware;
use SilverStripe\Core\Extensible;
use SilverStripers\AMP\Control\AMPDirector;


class AMPMiddleware implements HTTPMiddleware
{

	use Extensible;

	public function process(HTTPRequest $request, callable $delegate)
	{
        $this->detectAmp($request);

        /* @var $response HTTPResponse */
		$response = $delegate($request);
        $routeParams = $request->routeParams();
		if(!empty($routeParams['AMPSPage']) && AMPDirector::is_amp_allowed($routeParams['AMPSPage']) && $response && ($body = $response->getbody()) && AMPDirector::is_amp()) {
			$amp = new AMP();
			$amp->loadHtml($body, [
				'scope'		=> Scope::HTML_SCOPE
			]);
// 			if($ampHTML = $amp->convertToAmpHtml()) {
// 				$this->extend('updateAMPHTML', $ampHTML);
// 				$response->setBody($ampHTML);
// 			}
		}
		return $response;
	}

	private function detectAmp(HTTPRequest $request)
	{
		$url = $request->getURL();
		foreach (AMPDirector::URL_SUFFIXES as $suffix) {
			$suffix = '/' . $suffix;
			$endsWith = substr($url, -1 * strlen($suffix));
			if($endsWith == $suffix) {
				AMPDirector::set_amp(true);
				continue;
			}
		}
	}




}
