<?php

namespace Pixelpoems\LayoutOptions\Extensions;

use SilverStripe\Core\Extension;
use Pixelpoems\LayoutOptions\Services\LayoutService;
use Pixelpoems\SelectionField\CMSFields\SelectionField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;

class Image extends Extension
{
    public $owner;
    private static bool $hide_layout_option_image_orientation = false;

    private static bool $hide_layout_option_image_brightness = false;

    private static bool $hide_layout_option_image_shape = false;


    private static array $db = [
        'ImageOrientation' => 'Varchar',
        'ImageBrightness' => 'Varchar',
        'ImageShape' => 'Varchar',
    ];

    private static array $defaults = [
        'ImageOrientation' => 'left',
        'ImageBrightness' => 'default',
        'ImageShape' => 'default',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $layoutService = LayoutService::create();

        $fields->removeByName(['ImageOrientation', 'ImageBrightness', 'ImageShape']);

        $compositeField = CompositeField::create()->setTitle(_t('LayoutOptions.Image', 'Image'));

        if(!$this->owner->config()->get('hide_layout_option_image_orientation')) {

            $compositeField->push(
                SelectionField::create(
                    'ImageOrientation',
                    _t('Layout.ImageOrientation', 'Orientation'),
                    $layoutService->getImageOrientationOptions()
                ),
            );
        }

        if(!$this->owner->config()->get('hide_layout_option_image_brightness')) {
            $compositeField->push(
                SelectionField::create(
                    'ImageBrightness',
                    _t('Layout.ImageBrightness', 'Brightness'),
                    $layoutService->getImageBrightnessOptions()
                )
            );
        }

        if(!$this->owner->config()->get('hide_layout_option_image_shape')) {
            $compositeField->push(
                OptionsetField::create(
                    'ImageShape',
                    _t('Layout.ImageShape', 'Shape'),
                    $layoutService->getImageShapeOptions(),
                )
            );
        }

        $fields->addFieldsToTab('Root.' . _t('LayoutOptions.Layout', 'Layout'), [
            $compositeField
        ]);
    }

    public function ImageShape(): string
    {
        $class = 'is--';
        if($this->owner->getField('ImageShape')) {
            $class .= $this->owner->getField('ImageShape');
        } else {
            $class .= 'default';
        }


        return $class;
    }
}
