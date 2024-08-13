<?php

namespace Pixelpoems\LayoutOptions\Extensions;

use SilverStripe\i18n\i18n;
use SilverStripe\ORM\DataExtension;
use TractorCow\Fluent\State\FluentState;

class BaseElementExtension extends DataExtension
{
    /**
     * To add additional classes to a specific element, add a method to the element class
     * e.g.:
     * ```
     * public function getHolderClasses()
     * {
     *     $classes = parent::getHolderClasses()
     *     $classes .= ' my-class';
     *     return $classes;
     * }
     * ```
     */
    public function getHolderClasses(): string
    {
        $holderClasses = [];
        $element = $this->owner;

        if(class_exists('TractorCow\Fluent\State\FluentState')) {
            $enName =  FluentState::singleton()->withState(function(FluentState $state) use ($element) {
                i18n::set_locale('en_001');
                $name = $element->i18n_singular_name();
                $name = strtolower($name);
                $name = explode(' ', $name);
                return implode('', $name);
            });
        } else {
            i18n::set_locale('en_001');
            $name = $element->i18n_singular_name();
            $name = strtolower($name);
            $name = explode(' ', $name);
            $enName = implode('', $name);
        }

        $enName = str_replace(['/', '\\', '&'], '-', $enName);
        $holderClasses[] = 'el-' . $enName;

        // Adds the layout options to the holder classes when there is a value and the option is not hidden
        // Background
        if($element->BackgroundColor && !$element->config()->get('hide_layout_option_background_color')) $holderClasses[] = 'bg--' . $element->BackgroundColor;

        // Width
        if($element->LayoutWidth && !$element->config()->get('hide_layout_option__width')) $holderClasses[] = 'w--' . $element->LayoutWidth;

        // Text
        if($element->TextAlign && !$element->config()->get('hide_layout_option_text_align')) $holderClasses[] = 'a' . $element->TextAlign;
        if($element->TextColor && !$element->config()->get('hide_layout_option_text_color')) $holderClasses[] = 'tc--' . $element->TextColor;

        // Image
        if($element->ImageOrientation && !$element->config()->get('hide_layout_option_image_orientation')) $holderClasses[] = 'io--' . $element->ImageOrientation;
        if($element->ImageBrightness && !$element->config()->get('hide_layout_option_image_brightness')) $holderClasses[] = 'ib--' . $element->ImageBrightness;
        if($element->ImageShape && !$element->config()->get('hide_layout_option_image_shape')) $holderClasses[] = 'is--' . $element->ImageShape;

        // Adds the style variant and extra class to the holder classes
        if($element->getStyleVariant()) $holderClasses[] = $element->getStyleVariant();
        if($element->ExtraClass) $holderClasses[] = $element->ExtraClass;

        $this->owner->extend('updateHolderClasses', $holderClasses);
        return implode(' ', $holderClasses);
    }

    public function addSearchData($data)
    {
        if (!$this->owner->ShowTitle) {
            $data['title'] = '';
        }

        $data['content'] = $this->owner->HTML;
        return $data;
    }
}
