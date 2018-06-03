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
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Middleware\HTTPMiddleware;
use SilverStripers\AMP\Control\AMPDirector;


class AMPMiddleware implements HTTPMiddleware
{

	public function process(HTTPRequest $request, callable $delegate)
	{
		$this->detectAmp($request);

		$response = $delegate($request);
		if($response && ($body = $response->getbody()) && AMPDirector::is_amp()) {
			$amp = new AMP();
			$amp->loadHtml($body, [
				'scope'		=> Scope::HTML_SCOPE
			]);
			if($ampHTML = $amp->convertToAmpHtml()) {
				$response->setBody($ampHTML);
			}

//			$body = $this->processInputs($body);
//			$response->setBody($body);
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