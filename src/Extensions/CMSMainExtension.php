<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 3/8/19
 * Time: 4:13 PM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\AMP\Extensions;


use SilverStripe\CMS\Controllers\CMSMain;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripers\AMP\Control\AMPCache;
use SilverStripers\AMP\Control\AMPDirector;

class CMSMainExtension extends Extension
{

    public function updateEditForm(Form $form)
    {

        $record = $this->getRecord();
        if(AMPDirector::is_amp_allowed($record) && AMPCache::key_exists()) {
            $form->Actions()->insertAfter('action_publish',
                FormAction::create('clearAMPCache', 'Create AMP ⚡ Cache')
                    ->setUseButtonTag(true)
                    ->addExtraClass('btn btn-outline-primary')
            );
        }
    }

    public function clearAMPCache($data, Form $form)
    {
        /* @var $owner CMSMain */
        $owner = $this->owner;
        $id = $owner->currentPageID();
        $record = $owner->getRecord($id);
        $message = '';
        if($record && AMPDirector::is_amp_allowed($record)) {
            if($record->clearAmpCaches()) {
                $message = '⚡ AMP Caches cleared for this page';
            }
            else {
                $message = '⚡ Failed clearning AMP caches for this page';
            }
        }
        $owner->getResponse()->addHeader('X-Status', rawurlencode($message));
        return $owner->getResponseNegotiator()->respond($owner->getRequest());
    }


    /**
     * @return \SilverStripe\CMS\Model\SiteTree
     */
    private function getRecord()
    {
        /* @var $owner CMSMain */
        $owner = $this->owner;
        $id = $owner->currentPageID();
        $record = $owner->getRecord($id);
        return $record;
    }

}
