<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 3/8/19
 * Time: 5:51 PM
 * To change this template use File | Settings | File Templates.
 */

use DNADesign\Elemental\Models\BaseElement;
use SilverStripers\AMP\Extensions\AMPElementExtension;

if(class_exists(BaseElement::class)) {
    BaseElement::add_extension(AMPElementExtension::class);
}
