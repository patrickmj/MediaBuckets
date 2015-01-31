<?php

define('MEDIABUCKETS_PLUGIN_DIR', PLUGIN_DIR . '/MediaBuckets');

include(MEDIABUCKETS_PLUGIN_DIR . '/functions.php');


class MediaBucketsPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array('install', 
                              'items_browse_sql',
                              'config',
                              'config_form',
                              //'public_collections_show',
                              //'public_collections_browse_each'
            );

    protected $_filters = array(
        'admin_navigation_main'
        );
    
    public function hookInstall($args)
    {
        //install the MediaBucket ItemType
        $metadata = array('name' => __("MediaBucket"),
                          'description' => __("A bucket to hold media for use elsewhere, usually not a real item")
                );
        $elements = array(
                        array('name' => 'collection',
                              'description' => 'A collection ID that this bucket is associated with'
                             ),
                        array('name' => 'exhibit',
                              'description' => 'An exhibit ID that this bucket is associated with'
                             ),
                    );
        insert_item_type($metadata, $elements);
    }

    public function hookConfigForm($args)
    {
        include MEDIABUCKETS_PLUGIN_DIR . '/config_form.php';
    }
    
    public function hookConfig($args)
    {
        $post = $args['post'];
        set_option('media_buckets_ignore_buckets', $post['media_buckets_ignore_buckets']);
    }
    
    public function hookItemsBrowseSql($args)
    {
        if (get_option('media_buckets_ignore_buckets')) {
            $select = $args['select'];
            $db = get_db();
            //I don't feel like mucking about with checking whether the
            //join on ItemType is already present, so I'll just 
            //grab the ItemType for its id
            $itemType = $db->getTable('ItemType')->findByName('MediaBucket');
            $select->where("item_type_id != ?", $itemType->id);
            //WTF? != in a where clause ignores NULL values? wtfwtfwtf
            $select->orWhere("item_type_id IS NULL");
        }
    }
    
    public function filterAdminNavigationMain($tabs)
    {
        $tabs['MediaBuckets'] = array('uri' => url('media-buckets/buckets/browse'),
                                      'label' => __('Media Buckets')
                );
        return $tabs;
    }
    
    public static function getBucketForRecord($record)
    {
        $db = get_db();
        $itemType = $db->getTable('ItemType')->findByName('MediaBucket');
        $elementName = Inflector::underscore(get_class($record));
        $element = $db->getTable('Element')->findByElementSetNameAndElementName('Item Type Metadata', $elementName);
        $searchArray = array('advanced'
                              => array(
                                   array('element_id' => $element->id,
                                            'type' => 'is exactly',
                                            'terms' => $record->id
                                           )
                                  )
                            );
        $itemTable = $db->getTable('Item');
        $select = $itemTable->getSelect();
        $itemTable->applySearchFilters($select, $searchArray);
        $select->where('item_type_id = ?', $itemType->id);
        $select->limit(1);
        $bucket = $db->getTable('Item')->fetchObject($select);
        return $bucket;
    }
}