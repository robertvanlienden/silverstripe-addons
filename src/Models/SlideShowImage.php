<?php

namespace RobertVanLienden\SilverStripeAddons\Models;

use Page;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;

class SlideShowImage extends DataObject
{
    private static string $table_name = 'SSAddonsSlideShowImage';

    private static array $db = [
        'Title' => 'Varchar',
    ];

    private static array $has_one = [
        'Image' => Image::class,
        'Page' => Page::class,
    ];

    private static array $owns = [
        'Image'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['PageID', 'Image']);

        $fields->addFieldsToTab('Root.Main', [
            UploadField::create('Image', 'Image')
                ->setFolderName('slideshow-images')
        ]);

        return $fields;
    }
}
