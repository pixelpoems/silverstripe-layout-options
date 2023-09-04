<?php

namespace Pixelpoems\LayoutOptions\Extensions;

use Heyday\ColorPalette\Fields\ColorPaletteField;
use Pixelpoems\LayoutOptions\CMSFields\SelectionField;
use Pixelpoems\LayoutOptions\Services\LayoutService;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class Text extends DataExtension
{
    private static $db = [
        'HeadingTag' => 'Varchar',
        'TextColor' => 'Varchar',
        'TextAlign' => 'Varchar'
    ];

    private static $defaults = [
        'HeadingTag' => 'h2',
        'TextColor' => 'black',
        'TextAlign' => 'left'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $layoutService = LayoutService::create();

        $fields->removeByName(['HeadingTag', 'TextColor', 'TextAlign']);
        $fields->addFieldsToTab('Root.Layout', [
            CompositeField::create(
                SelectionField::create(
                    'HeadingTag',
                    _t('LayoutOptions.HeadingTag', 'Heading Tag'),
                    $layoutService->getHeadingTagOptions()
                ),
                ColorPaletteField::create(
                    'TextColor',
                    _t('LayoutOptions.Color', 'Color'),
                    $layoutService->getTextColorOptions()
                ),
                SelectionField::create(
                    'TextAlign',
                    _t('LayoutOptions.Alignment', 'Alignment'),
                    $layoutService->getAlignOptions()
                ),
            )->setTitle(_t('LayoutOptions.Text', 'Text'))

        ]);

        parent::updateCMSFields($fields);
    }
}
