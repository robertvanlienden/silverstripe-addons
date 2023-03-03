<?php

namespace RobertVanLienden\SilverStripeAddons\Extensions;

use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;

class PageExtension extends  DataExtension {

    private static array $db = [
        'HeaderTitle' => 'Varchar(225)',
        'HeaderContent' => 'HTMLText',
        'HeaderDisabled' => 'Boolean',
        'DarkContent' => 'Boolean',
    ];

    private static array $has_one = [
        'HeaderImage' => Image::class,
        'HeaderButtonLink' => Link::class,
    ];

    private static array $owns = [
        'HeaderImage'
    ];


    public function updateCMSFields(FieldList $fields)
    {
        parent::updateCMSFields($fields);

        $siteConfig = SiteConfig::current_site_config();

        if($siteConfig->AddonsHeaderFeatureFlag) {
            $fields->addFieldsToTab('Root.Header', [
                CheckboxField::create('HeaderDisabled', 'Disable the header on this page'),
                CheckboxField::create('DarkContent', 'Content in black'),
                UploadField::create('HeaderImage')
                    ->setFolderName('header-images'),
                TextField::create('HeaderTitle', 'Header title'),
                HTMLEditorField::create('HeaderContent', 'Header content'),
                LinkField::create('HeaderButtonLink', 'Header button link', $this->owner)
                    ->setDescription('The title will be used on the button as content'),
            ]);
        }
    }
}
