# Silverstripe Layout Options Module
[![stability-beta](https://img.shields.io/badge/stability-beta-33bbff.svg)](https://github.com/mkenney/software-guides/blob/master/STABILITY-BADGES.md#beta)

## Requirements

* Silverstripe CMS ^4.0
* Silverstripe Framework ^4.0
* Versioned Admin ^1.0

## Installation
```
composer require pixelpoems/silverstripe-layout-options
```

## Base Configuration
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

## Update Options
For each option set, you can use a hook to update/expand the options from which the user can choose.
```yml
Pixelpoems\LayoutOptions\Services\LayoutService:
  extensions:
    - Namespace\YourLayoutServiceExtension
```
```php
public function updateAlignOptions(&$options)
{
    // Do your updates here
}

public function updateTextColorOptions(&$options)
{
    // Do your updates here
}

public function updateAlignOptions(&$options)
{
    // Do your updates here
}

public function updateLayoutWidthOptions(&$options)
{
    // Do your updates here
}

public function updateBackgroundColorOptions(&$options)
{
    // Do your updates here
}
```


## Reporting Issues
Please [create an issue](https://github.com/pixelpoems/silverstripe-layout-options/issues) for any bugs you've found, or
features you're missing.

## Credits
Icons from Feather Icons - https://feathericons.com/
