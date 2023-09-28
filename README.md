# Silverstripe Layout Options Module
[![stability-beta](https://img.shields.io/badge/stability-beta-33bbff.svg)](https://github.com/mkenney/software-guides/blob/master/STABILITY-BADGES.md#beta)

This module provides extensions for layout options. The options can be attached to pages, elements or each data object. By default this module comes with options for text, background and width. Furthermore, this package contains a selection field wich is based on [color palate field by heyday](https://github.com/heyday/silverstripe-colorpalette).

* [Requirements](#requirements)
* [Installation](#installation)
* [Configuration](#configuration)
* [Default Layout Options](#default-layout-options)
* [Update Options](#update-options)
* [Usage of Selection Field](#usage-of-selection-field)
* [Usage in Frontend](#usage-in-frontend)
* [Reporting Issues](#reporting-issues)
* [Credits](#credits)

## Requirements

* Silverstripe CMS >=4.0
* Silverstripe Framework >=4.0
* Versioned Admin >=1.0
* [Silverstripe Color Palette Field ^2.1](https://github.com/heyday/silverstripe-colorpalette)

## Installation
```
composer require pixelpoems/silverstripe-layout-options
```

## Configuration
Add the desired extension on Page:
```yml
Page:
  extensions:
    - Pixelpoems\LayoutOptions\Extensions\Text
    - Pixelpoems\LayoutOptions\Extensions\Background
    - Pixelpoems\LayoutOptions\Extensions\Width
```

or Element (if you use Elemental form DNADesign e.g.):
```yml
DNADesign\Elemental\Models\BaseElement:
  inline_editable: false
  extensions:
    - Pixelpoems\LayoutOptions\Extensions\Text
    - Pixelpoems\LayoutOptions\Extensions\Background
    - Pixelpoems\LayoutOptions\Extensions\Width
```
The fields will appear in the order the extensions are added within the yml config.

Each entity can be hidden if they should not appeare e.g.:
```yml
Page:
  hide_layout_option_heading_tag: true
  hide_layout_option_text_color: true
  hide_layout_option_text_align: true
  hide_layout_option_background_color: true
  hide_layout_option_width: true
```

## Default Layout Options
### Text
![resources/example-text.png](resources/example-text.png)

### Background
![resources/example-background.png](resources/example-background.png)

### Width
![resources/example-width.png](resources/example-width.png)

## Update Options
For each option set, you can use a hook to update/expand the options from which the user can choose.
```yml
Pixelpoems\LayoutOptions\Services\LayoutService:
  extensions:
    - Namespace\YourLayoutServiceExtension
```
```php
public function updateHeadingTagOptions(&$options)
{
    // Add an option
    $options['h5'] = [
        'Value' => 'h5',
        'Title' => 'H5',
    ];
}

public function updateTextColorOptions(&$options)
{
    // Add an option
    $options['text-light'] = '#ffcdb2';
}

public function updateAlignOptions(&$options)
{
    // Add an option
    $options['justify'] = [
        'Value' => 'justify',
        'Title' => 'Justify',
        'ShowTitle' => true,
        'Icon' => 'align-justify'
    ];
}

public function updateLayoutWidthOptions(&$options)
{
    // Add options
    $options = array_merge($options, [
        'xs' => [
            'Value' => 'xs',
            'Title' => 'XS',
            'ShowTitle' => true,
        ],
        'xl' => [
            'Value' => 'xl',
            'Title' => 'XL',
            'ShowTitle' => true,
        ]
    ];
}

public function updateBackgroundColorOptions(&$options)
{
    // Overwrite the default Background Colors
    $options = [
        'white' => '#ffffff',
        'bg-1' => '#ffcdb2',
        'bg-2' => '#ffb4a2',
        'bg-3' => '#e5989b',
        'bg-4' => '#b5838d',
        'bg-5' => '#6d6875',
        'black' => '#000000',
    ];
}
```

## Usage of Selection Field
Based on: `SilverStripe\Forms\OptionsetField` and `Heyday\ColorPalette\Fields\ColorPaletteField`
```php
private static $db = [
    'Alignment' => 'Varchar',
];

public function getCMSFields()
{
    $fields = parent::getCMSFields();

    $fields->addFieldsToTab('Root.Main', [

        SelectionField::create(
           $name = 'Alignment',
           $title = 'Alignment',
           $source = [
                'left' => [
                    'Value' => 'left',
                    'Title' => _t('LayoutOptions.Left', "Left"),
                    'ShowTitle' => true,
                    'Icon' => 'align-left'
                ],
                'center' => [
                    'Value' => 'center',
                    'Title' => _t('LayoutOptions.Center', "Center"),
                    'ShowTitle' => true,
                    'Icon' => 'align-center'
                ],
                'right' => [
                    'Value' => 'right',
                    'Title' => _t('LayoutOptions.Right', "Right"),
                    'ShowTitle' => true,
                    'Icon' => 'align-right'
                ],
                $value = 'left'
        );

    ]);
}
```

To display Icons you need to reference Feather Icons:
https://github.com/feathericons/feather/tree/main/icons

If no Icon is defined within the array, the box will display the title!
You can define an alternative box content when you define "Content" within Options:
```php
'medium' => [
    'Value' => 'medium',
    'Title' => _t('LayoutOptions.Medium', 'Medium'),
    'ShowTitle' => true,
    'Content' => 'M'
],
```

## Usage in Frontend
TODO

## Reporting Issues
Please [create an issue](https://github.com/pixelpoems/silverstripe-layout-options/issues) for any bugs you've found, or
features you're missing.

## Credits
Icons from [Feather Icons](https://feathericons.com/) \
Selection Field is based on [Heyday's Color Palette Field](https://github.com/heyday/silverstripe-colorpalette)
