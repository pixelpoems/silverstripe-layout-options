<?php

namespace Pixelpoems\LayoutOptions\Services;

use SilverStripe\Control\Controller;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injectable;

class LayoutService extends Controller
{
    use Injectable;
    use Configurable;

    /**
     * Used within classes: Text
     * @return array
     */
    public function getHeadingTagOptions(): array
    {
        $options = self::config()->get('heading_tag_options');

        if(!$options) {
            $options = [
                'h2' => [
                    'Value' => 'h2',
                    'Title' => 'H2',
                ],
                'h3' => [
                    'Value' => 'h3',
                    'Title' => 'H3',
                ],
                'h4' => [
                    'Value' => 'h4',
                    'Title' => 'H4',
                ],
            ];
        }

        $this->extend('updateHeadingTagOptions', $options);
        return $options;
    }

    /**
     * Used within classes: Text
     * @return array
     */
    public function getTextColorOptions(): array
    {
        $options = self::config()->get('text_color_options');

        if(!$options) {
            $options = [
                'black' => '#000',
                'white' => '#fff'
            ];
        }

        $this->extend('updateTextColorOptions', $options);
        return $options;
    }

    /**
     * Used within classes: Text
     * @return array
     */
    public function getAlignOptions(): array
    {
        $options = self::config()->get('align_options');

        if(!$options) {
            $options = [
                'l' => [
                    'Value' => 'l',
                    'Title' => _t('LayoutOptions.Left', "Left"),
                    'ShowTitle' => true,
                    'Icon' => 'align-left'
                ],
                'c' => [
                    'Value' => 'c',
                    'Title' => _t('LayoutOptions.Center', "Center"),
                    'ShowTitle' => true,
                    'Icon' => 'align-center'
                ],
                'r' => [
                    'Value' => 'r',
                    'Title' => _t('LayoutOptions.Right', "Right"),
                    'ShowTitle' => true,
                    'Icon' => 'align-right'
                ],
            ];
        }

        $this->extend('updateAlignOptions', $options);
        return $options;
    }

    /**
     * Used within classes: Width
     * @return array
     */
    public function getLayoutWidthOptions(): array
    {
        $options = self::config()->get('layout_width_options');

        if(!$options) {
            $options = [
                'sm' => [
                    'Value' => 'sm',
                    'Title' => _t('LayoutOptions.Small', "Small"),
                    'ShowTitle' => true,
                    'Content' => 'SM'
                ],
                'md' => [
                    'Value' => 'md',
                    'Title' => _t('LayoutOptions.Medium', "Medium"),
                    'ShowTitle' => true,
                    'Content' => 'M'
                ],
                'lg' => [
                    'Value' => 'lg',
                    'Title' => _t('LayoutOptions.Large', "Large"),
                    'ShowTitle' => true,
                    'Content' => 'LG'
                ],
            ];
        }

        $this->extend('updateLayoutWidthOptions', $options);
        return $options;
    }


    /**
     * Used within classes: Background
     * @return array
     */
    public function getBackgroundColorOptions(): array
    {
        $options = self::config()->get('background_color_options');

        if(!$options) {
            $options = [
                'white' => '#fff',
                'light' => '#ddd',
                'dark' => '#aaa',
                'black' => '#000'
            ];
        }


        $this->extend('updateBackgroundColorOptions', $options);
        return $options;
    }

    public function getSelectedBackgroundColor($key): string
    {
        return $this->getBackgroundColorOptions()[$key];
    }


    public function getImageOrientationOptions(): array
    {
        $options = [
            'left' => [
                'Value' => 'left',
                'Title' => _t('LayoutOptions.Left', "Left"),
                'ShowTitle' => true,
                'Icon' => 'arrow-left'
            ],
            'right' => [
                'Value' => 'right',
                'Title' => _t('LayoutOptions.Right', "Right"),
                'ShowTitle' => true,
                'Icon' => 'arrow-right'
            ],
        ];

        $this->extend('updateImageOrientationOptions', $options);

        return $options;
    }

    public function getImageBrightnessOptions(): array
    {
       $options = [
           'bright' => [
               'Value' => 'bright',
               'Title' => _t('LayoutOptions.ImageBright', "Bright"),
               'ShowTitle' => true,
               'Icon' => 'sun'
           ],
           'default' => [
               'Value' => 'default',
               'Title' => _t('LayoutOptions.ImageDefault', "Default"),
               'ShowTitle' => true,
               'Icon' => 'maximize'
           ],
           'dark' => [
               'Value' => 'dark',
               'Title' => _t('LayoutOptions.ImageDark', "Dark"),
               'ShowTitle' => true,
               'Icon' => 'moon'
           ],
       ];

         $this->extend('updateImageBrightnessOptions', $options);
        return $options;
    }

    public function getImageShapeOptions(): array
    {
        $options = [
            'default' => 'Default',
            'circle' => 'Circle',
            'rectangle-horizontal' => 'Rectangle Horizontal',
            'rectangle-vertical' => 'Rectangle Vertical',
            'square' =>  'Square',
        ];

        $this->extend('updateImageShapeOptions', $options);
        return $options;
    }
}
