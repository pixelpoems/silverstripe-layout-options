<?php

namespace Pixelpoems\LayoutOptions\Extensions;

use Pixelpoems\LayoutOptions\CMSFields\SelectionField;
use Pixelpoems\LayoutOptions\Services\LayoutService;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class Width extends DataExtension
{
    private static $db = [
        'LayoutWidth' => 'Varchar'
    ];

    private static $defaults = [
        'LayoutWidth' => 'default'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $layoutService = LayoutService::create();
        $fields->addFieldsToTab('Root.Layout', [
            SelectionField::create(
                'LayoutWidth',
                _t('LayoutOptions.LayoutWidth', 'Layout Width'),
                $layoutService->getLayoutWidthOptions()
            ),
        ]);

        parent::updateCMSFields($fields);
    }
}
