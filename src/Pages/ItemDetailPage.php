<?php

namespace RobertVanLienden\SilverStripeAddons\Pages;

use RobertVanLienden\SilverStripeAddons\Models\SlideShowImage;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;

class ItemDetailPage extends \Page
{
    private static string $table_name = 'SSAddonsItemDetailPage';
    private static string $icon_class = 'font-icon-p-article';
    private static string $description = 'A portfolio item page';

    private static bool $can_be_root = false;

    private static array $db = [
        'ProjectSummary' => 'HTMLText',
        'ButtonText' => 'Varchar(225)',
    ];

    private static array $has_one = [
        'OverviewImage' => Image::class,
    ];

    private static array $has_many = [
        'SlideShowImages' => SlideShowImage::class,
    ];

    private static array $owns = [
        'OverviewImage',
        'SlideShowImages'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Project', [
            UploadField::create('OverviewImage')
                ->setFolderName('portfolio'),
            HTMLEditorField::create('ProjectSummary')
                ->setDescription('A summary for the portfolio detail page.
                Without summary the first 50 characters of the content will get used.'),
            TextField::create('ButtonText')
                ->setDescription('The text that will get shown on the link on the project summary'),
        ]);

        $slideShowImagesConfig = GridFieldConfig_RecordEditor::create();

        $fields->addFieldsToTab('Root.SlideShowImages', [
            GridField::create('Images',
                'Slideshow images',
                $this->SlideShowImages(),
                $slideShowImagesConfig)
        ]);

        return $fields;
    }

    public function getShortContent(string $content = null): string
    {
        if (!$content) {
            $content = '';
        }

        $content = strip_tags($content);

        return substr($content, 0, 500) . ' ...';
    }
}
