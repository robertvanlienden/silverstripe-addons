<?php

namespace RobertVanLienden\SilverStripeAddons\Pages;

use Restruct\GridFieldSiteTreeButtons\GridFieldAddNewSiteTreeItemButton;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Lumberjack\Forms\GridFieldSiteTreeAddNewButton;
use SilverStripe\ORM\DataList;
use SilverStripe\Lumberjack\Forms\GridFieldConfig_Lumberjack;

/**
 *
 */
class ItemOverviewPage extends \Page
{

    private static string $table_name = 'SSAddonsItemOverviewPage';
    private static string $icon_class = 'font-icon-p-articles';
    private static string $description = 'A page with an overview with your portfolio items.';

    private static array $allowed_children = [
        ItemDetailPage::class
    ];

    private static array $db = [
        'AllItemDetailPages' => 'Boolean',
    ];

    private static array $defaults = [
        'AllItemDetailPages' => false,
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->addFieldsToTab('Root.Main', [
                    CheckboxField::create('AllItemDetailPages', 'Display all item detail pages on this page')
                        ->setDescription('By default a overview page only shows pages under THIS overview page. '),
                ], 'Title');

                //$itemGridConfig = GridFieldConfig_Lumberjack::create();

                //if ($this->AllItemDetailPages === 0) {
                //    $fields->addFieldsToTab('Root.Items', [
                //        $this->createGridField('Items', ItemDetailPage::get()->where(['ParentID' => $this->ID])),
                //    ]);
                //} else {
                //    $fields->addFieldsToTab('Root.Items', [
                //        $this->createGridField('Items', ItemDetailPage::get())
                //    ]);
                //}
            }
        );

        return parent::getCMSFields();
    }

    public function getLumberjackPagesForGridfield(): DataList
    {
        if ($this->AllItemDetailPages === 0) {
            return ItemDetailPage::get()->where(['ParentID' => $this->ID]);
        }

        return ItemDetailPage::get();
    }

    public function getLumberjackTitle(): string
    {
        return 'Items';
    }

    public function getItemPages(?string $limit = null, ?string $all = null): DataList
    {
        if ($all == '1' && !$limit) {
            return ItemDetailPage::get();
        }

        if ($all && $limit) {
            return ItemDetailPage::get()->limit($limit);
        }

        $result = ItemDetailPage::get()
            ->where(['ParentID' => $this->ID]);

        if ($limit) {
            return $result->limit($limit);
        }

        return $result;
    }
}
