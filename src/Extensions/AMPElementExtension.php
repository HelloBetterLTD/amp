<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 3/8/19
 * Time: 5:50 PM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Extensions;


use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Core\ClassInfo;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripers\AMP\Control\AMPDirector;

class AMPElementExtension extends DataExtension
{


    public function updateRenderTemplates(&$templates, $suffix)
    {
        if(AMPDirector::is_amp()) {
            $owner = $this->owner;
            $classes = ClassInfo::ancestry($owner->ClassName);
            $classes = array_reverse($classes);
            $templates = [];

            foreach ($classes as $key => $class) {
                if ($class == BaseElement::class) {
                    continue;
                }

                if ($class == DataObject::class) {
                    break;
                }

                if ($style = $owner->Style) {
                    $templates[$class][] = $class . $suffix . '_' . $owner->getAreaRelationName() . '_' . $style . '_AMP';
                    $templates[$class][] = $class . $suffix . '_' . $owner->getAreaRelationName() . '_' . $style;
                    $templates[$class][] = $class . $suffix . '_' . $style . '_' . 'AMP';
                    $templates[$class][] = $class . $suffix . '_' . $style;
                }
                $templates[$class][] = $class . $suffix . '_' . $owner->getAreaRelationName() . '_AMP';
                $templates[$class][] = $class . $suffix . '_' . $owner->getAreaRelationName();
                $templates[$class][] = $class . $suffix . '_AMP';
                $templates[$class][] = $class . $suffix;
            }
        }
    }

}
