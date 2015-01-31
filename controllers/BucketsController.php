<?php
class MediaBuckets_BucketsController extends Omeka_Controller_AbstractActionController
{
    public function browseAction()
    {
        $itemType = $this->_helper->db->getTable('ItemType')->findByName('MediaBucket');
        $itemTable = $this->_helper->db->getTable('Item');
        $select = $itemTable->getSelect();
        $select->where('item_type_id = ?', $itemType->id);
        $buckets = $itemTable->fetchObjects($select);
        $this->view->buckets = $buckets;
    }
    
    public function testAction()
    {
        
    }
}