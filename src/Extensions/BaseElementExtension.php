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

        $holderClasses[] = 'el-' . $enName;
        if($element->BackgroundColor) $holderClasses[] = 'bg--' . $element->BackgroundColor;
        if($element->LayoutWidth) $holderClasses[] = 'w--' . $element->LayoutWidth;
        if($element->TextAlign) $holderClasses[] = 'a' . $element->TextAlign;
        if($element->TextColor) $holderClasses[] = 'tc--' . $element->TextColor;
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
