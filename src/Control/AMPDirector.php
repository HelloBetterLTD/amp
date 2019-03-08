<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 6/3/18
 * Time: 10:58 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Control;


use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Extensible;

class AMPDirector
{

	use Configurable;
	use Extensible;

	const URL_SUFFIX = 'amp';
	const URL_SUFFIXES = [
	    'amp',
        'amp.html'
    ];

	private static $allowed_classes = [];

	private static $amp = false;

	private static $amp_allowed = [];

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

	public static function is_amp_allowed($class)
    {
        if(is_object($class)) {
            $class = get_class($class);
        }

        if(empty(AMPDirector::$amp_allowed[$class])) {
            $ret = false;
            if ($class) {
                $ret = true;
                $classes = self::config()->get('allowed_classes');
                if (!empty($classes)) {
                    $ret = false;
                    foreach ($classes as $classCheck) {
                        $subClasses = ClassInfo::subclassesFor($classCheck);
                        if(in_array($class, $subClasses)) {
                            $ret = true;
                        }
                    }
                }
            }
            AMPDirector::$amp_allowed[$class] = $ret;
        }
        return AMPDirector::$amp_allowed[$class];
    }



}
