<?php

namespace Pixelpoems\LayoutOptions\Extensions;

use Heyday\ColorPalette\Fields\ColorPaletteField;
use Pixelpoems\LayoutOptions\Services\LayoutService;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class Background extends DataExtension
{
    private static $db = [
        'BackgroundColor' => 'Varchar',
    ];

    private static $defaults = [
        'BackgroundColor' => 'white',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $layoutService = LayoutService::create();
        $fields->removeByName(['BackgroundColor']);
        $fields->addFieldsToTab('Root.Layout', [
            CompositeField::create(
                ColorPaletteField::create(
                    'BackgroundColor',
                    _t('LayoutOptions.Color', 'Color'),
                    $layoutService->getBackgroundColorOptions()
                )
            )->setTitle(_t('LayoutOptions.Background', 'Background'))
        ]);
        parent::updateCMSFields($fields);
    }

    public function getBackgroundColorHEX(): string
    {
        $layoutService = LayoutService::create();
        if($this->owner->BackgroundColor) {
            return $layoutService->getSelectedBackgroundColor($this->owner->BackgroundColor) ?: '#fff';
        }
        return '#fff';
    }
}
