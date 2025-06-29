<?php

namespace Pixelpoems\LayoutOptions\Extensions;

use SilverStripe\Core\Extension;
use Heyday\ColorPalette\Fields\ColorPaletteField;
use Pixelpoems\LayoutOptions\Services\LayoutService;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;

class Background extends Extension
{
    public $owner;
    private static bool $hide_layout_option_background_color = false;

    private static array $db = [
        'BackgroundColor' => 'Varchar',
    ];

    private static array $defaults = [
        'BackgroundColor' => 'white',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $layoutService = LayoutService::create();
        $fields->removeByName(['BackgroundColor']);
        $displayField = false;

        $compositeField = CompositeField::create()->setTitle(_t('LayoutOptions.Background', 'Background'));

        if(!$this->owner->config()->get('hide_layout_option_background_color')) {
            $compositeField->push(
                ColorPaletteField::create(
                    'BackgroundColor',
                    _t('LayoutOptions.Color', 'Color'),
                    $layoutService->getBackgroundColorOptions()
                )
            );
            $displayField = true;
        }

        if($displayField) {
            $fields->addFieldToTab(
                'Root.' . _t('LayoutOptions.Layout', 'Layout'),
                $compositeField
            );
        }

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
