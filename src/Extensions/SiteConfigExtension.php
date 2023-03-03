<?php

namespace RobertVanLienden\SilverStripeAddons\Extensions;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{
    private static array $db = [
        'AddonsHeaderFeatureFlag' => 'Boolean',
        'FooterLeft' => 'HTMLText',
        'FooterRight' => 'HTMLText',
    ];

    private static array $has_one = [
        'HeaderLogo' => Image::class,
    ];
    private static array $owns = [
        'HeaderLogo',
    ];

    private static array $defaults = [
        'AddonsHeaderFeatureFlag' => true,
    ];

    public function updateCMSFields(FieldList $fields)
    {
        parent::updateCMSFields($fields);

        $fields->addFieldsToTab('Root.SilverstripeAddonsSettings.Features', [
            LiteralField::create('AddonsDescritpion', '
<h3>SilverStripe Addons Features</h3>
<p>Here you can turn on/off features for SilverStripe addons</p>
'),
            CompositeField::create([
                CheckboxField::create('AddonsHeaderFeatureFlag', 'Turn on header visual images with content on all pages')
                    ->setDescription('This feature flag adds a header visual to all pages.
The header needs to get configured in the SilverStripe template.
You can also use <a href="https://github.com/robertvanlienden/silverstripe-bulma-portfolio-theme" target="_blank">
robertvanlienden/silverstripe-bulma-portfolio-theme</a>.')
            ])
        ]);

        $fields->addFieldsToTab('Root.SilverstripeAddonsSettings.Header', [
            UploadField::create('HeaderLogo', 'Header logo')
                ->setFolderName('header-logo')
        ]);

        $fields->addFieldsToTab('Root.SilverstripeAddonsSettings.Footer', [
            HTMLEditorField::create('FooterLeft', 'Footer left'),
            HTMLEditorField::create('FooterRight', 'Footer right'),
        ]);
    }
}
