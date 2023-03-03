<?php

namespace RobertVanLienden\SilverStripeAddons\Pages;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\ORM\DataList;

/**
 *
 */
class ItemOverviewPage extends \Page
{

    private static string $table_name = 'SSAddonsItemOverviewPage';
    private static string $icon_class = 'font-icon-p-articles';
    private static string $description = 'A page with an overview with your portfolio items.';

    private static array $db = [
        'AllItemDetailPages' => 'Boolean',
    ];

    private static array $defaults = [
        'AllItemDetailPages' => false,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            CheckboxField::create('AllItemDetailPages', 'Display all item detail pages on this page')
                ->setDescription('By default a overview page only shows pages under THIS overview page. '),
        ], 'Title');

        $itemGridConfig = GridFieldConfig_RecordEditor::create();

        if ($this->AllItemDetailPages === 0) {
            $fields->addFieldsToTab('Root.Items', [
                GridField::create('ItemPages',
                    'Item detail pages',
                    ItemDetailPage::get()->where(['ParentID' => $this->ID]),
                    $itemGridConfig)
            ]);
        } else {
            $fields->addFieldsToTab('Root.Items', [
                GridField::create('ItemPages',
                    'Item pages',
                    ItemDetailPage::get(),
                    $itemGridConfig)
            ]);
        }


        return $fields;
    }

    private static array $allowed_children = [
        ItemDetailPage::class
    ];

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
