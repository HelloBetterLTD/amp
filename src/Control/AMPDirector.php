<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 6/3/18
 * Time: 10:58 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Control;


use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Extensible;

class AMPDirector
{

	use Configurable;
	use Extensible;

	const URL_SUFFIX = 'amp';
	const URL_SUFFIXES = ['amp', 'amp.html'];

	private static $amp = false;

	public static function set_amp($amp = true)
	{
		self::$amp = $amp;
	}

	public static function get_amp()
	{
		return self::$amp;
	}

	public static function is_amp()
	{
		return self::get_amp();
	}



}