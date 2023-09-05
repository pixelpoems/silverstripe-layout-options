<?php

namespace Pixelpoems\LayoutOptions\Extensions;

use Pixelpoems\LayoutOptions\CMSFields\SelectionField;
use Pixelpoems\LayoutOptions\Services\LayoutService;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class Width extends DataExtension
{
    private static bool $hide_layout_option__width = false;

    private static array $db = [
        'LayoutWidth' => 'Varchar'
    ];

    private static array $defaults = [
        'LayoutWidth' => 'medium'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $layoutService = LayoutService::create();
        $fields->removeByName(['LayoutWidth']);

        $displayField = false;

        $compositeField = CompositeField::create()->setTitle(_t('LayoutOptions.Width', 'Width'));

        if(!$this->owner->config()->get('hide_layout_option__width')) {
            $compositeField->push(
                SelectionField::create(
                    'LayoutWidth',
                    _t('LayoutOptions.Width', 'Width'),
                    $layoutService->getLayoutWidthOptions()
                ),
            );
            $displayField = true;
        }

        if($displayField) {
            $fields->addFieldToTab(
                'Root.' . _t('LayoutOptions.Layout', 'Layout'),
                $compositeField
            );
        }

        parent::updateCMSFields($fields);
    }
}
