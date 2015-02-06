<?php

function media_buckets_record_files($record)
{
    $bucket = MediaBucketsPlugin::getBucketForRecord($record);
    if($bucket) {
        return $bucket->Files;
    }
}

function media_buckets_record_image($record, $index = 0, $imageType = 'thumbnail', $props = array())
{
    $bucket = MediaBucketsPlugin::getBucketForRecord($record);
    if($bucket) {
        if ($index == 'random') {
            $files = $bucket->Files;
            $count = count($files);
            $index = rand(0, $count-1);
        }
        return item_image($imageType, $props, $index, $bucket);
    }
    //fallback to record_image
    return record_image($record, $imageType, $props);
}

function media_buckets_record_gallery($record, $attrs = array(), $imageType = 'square_thumbnail', $filesShow = false)
{
    $bucket = MediaBucketsPlugin::getBucketForRecord($record);
    if($bucket) {
        return item_image_gallery($attrs, $imageType, $filesShow, $bucket);
    }
    //fallback to record_image 
    return record_image($record, $imageType, array());
}