<?php

namespace Pixelpoems\LayoutOptions\Extensions;

use Pixelpoems\SelectionField\CMSFields\SelectionField;
use Heyday\ColorPalette\Fields\ColorPaletteField;
use Pixelpoems\LayoutOptions\Services\LayoutService;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class Text extends DataExtension
{
    private static bool $hide_layout_option_heading_tag = false;

    private static bool $hide_layout_option_text_color = false;

    private static bool $hide_layout_option_text_align = false;

    private static array $db = [
        'HeadingTag' => 'Varchar',
        'TextColor' => 'Varchar',
        'TextAlign' => 'Varchar'
    ];

    private static array $defaults = [
        'HeadingTag' => 'h2',
        'TextColor' => 'black',
        'TextAlign' => 'left'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName(['HeadingTag', 'TextColor', 'TextAlign']);
        $layoutService = LayoutService::create();
        $displayField = false;

        $compositeField = CompositeField::create()->setTitle(_t('LayoutOptions.Text', 'Text'));
        if(!$this->owner->config()->get('hide_layout_option_heading_tag')) {
            $compositeField->push(
                SelectionField::create(
                    'HeadingTag',
                    _t('LayoutOptions.HeadingTag', 'Heading Tag'),
                    $layoutService->getHeadingTagOptions()
                )
            );
            $displayField = true;
        }

        if(!$this->owner->config()->get('hide_layout_option_text_color')) {
            $compositeField->push(
                ColorPaletteField::create(
                    'TextColor',
                    _t('LayoutOptions.Color', 'Color'),
                    $layoutService->getTextColorOptions()
                )
            );
            $displayField = true;
        }

        if(!$this->owner->config()->get('hide_layout_option_text_align')) {
            $compositeField->push(
                SelectionField::create(
                    'TextAlign',
                    _t('LayoutOptions.Alignment', 'Alignment'),
                    $layoutService->getAlignOptions()
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


        parent::updateCMSFields($fields);
    }
}
