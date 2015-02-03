# MediaBuckets
Omeka plugin that allows Items of type "MediaBucket' to be a (optionally) sequestered bucket for media for use elsewhere.

## Background

WordPress users coming to Omeka are often stymied by not having a media upload, for uploading files to incorporate elsewhere. In the Omeka model, all files uploaded are attached to Omeka Items. But, sometimes files are not properly understood as Items in an Omeka site.

The standard workaround has been to upload files as items, then pull in the files ignoring the items. That works, but raises questions about "What is an Item in Omeka, anyway?". Technologically, that's what it is. but conceptually and presentationally, maybe that kind of Item isn't really an "Item" for presentation. This leads to a conflict between the presentation needs and the conceptual needs.

This plugin is an attempt to mitigate that pain.

## Usage

The plugin creates a new Item Type in Omeka calles "MediaBucket". The intent of that Item Type is to be a repository (or, bucket) for files to use elsewhere in publishing, but might not be 'real' Items in your Omeka site. The only useful thing that it does is block items of type "MediaBucket" from showing up in the item browse and other pages. That's optional in the configuration. 

If you want to upload some files that are not really attached to anything, pretend by creating a new Item with Type "MediaBucket". Add all the files you want to that. Use shortcodes to stuff them into your pages.

As a convenience, the plugin also adds some functions for displaying media at random places. This isn't actually new functionality -- it could be done easily with core functions -- but if it makes life easier, here it is. In fact, the functions this plugin provides mostly just reuse existing functions. 

The functions are:

```php
media_buckets_record_files($record)
```

```php
media_buckets_record_image($record, $index = 0, $imageType = 'thumbnail', $props = array())
```
See [item_image](http://omeka.readthedocs.org/en/latest/Reference/libraries/globals/item_image.html)

```php
media_buckets_record_gallery($record, $attrs = array(), $imageType = 'square_thumbnail', $filesShow = false)
```
See [item_image_gallery](http://omeka.readthedocs.org/en/latest/Reference/libraries/globals/item_image_gallery.html)

The MediaBucket item type comes with two elements, 'collection' and 'exhibit'. If you enter a valid record id for a collection or exhibit, that associates that bucket with that record type and id, letting you use the functions and shortcodes to display images. 

For example, if you have created a MediaBucket and said `collection` = 42, then if you dig up that collection record in your view and do `media_buckets_record_image($record)`, it will display the image that you had added to that bucket. If more than one image is in that MediaBucket, it'll cycle through random choices.

I don't know what will happen if you create more than one MediaBucket with the same record type and id. Play at your own risk.

Remember, MediaBuckets in this plugin ARE ITEMS in Omeka. I'm just helping to conceal that fact. That means that that you can use your own trickery with existing Omeka functions on items and files to dig media up as needed. The only thing this plugin really adds is hiding Items of ItemType 'MediaBucket'.

## Shortcodes

A shortcode like this will let you insert a gallery of images for a collection. The shortcodes presume that you have created MediaBucket Items with the collection or exhibit data set on the bucket. That is, these work when there is a bucket with `collection` set to `119`.

```
[media_buckets record_class='collection' id='119'  gallery='true' image_type='fullsize']
```

That's the full set of options in the shortcode. The most minimal usage is just the class and id:

```
[media_buckets record_class='collection' id='119']
```

and defaults will be in effect. 

Remember, too, that MediaBuckets ARE ITEMS. That means that other shortcodes, like `[files]` can be used more directly. 

## Advanced Usage

Above, you saw, for example, that `collection` would dig up records of class `Collection`. That pattern should work in general. If your site has a model called `MyThing`, then you could add an element to the MediaBucket ItemType called `my_thing`, and record an id just like you would with a `collection` element, and the same behavior will happen. 

For example, add a `simple_pages_page` element to your MediaBucket, then add this to the top of how your theme handles SimplePagesPage show page, and the images should show up.

```php
<?php echo media_buckets_record_gallery($simple_pages_page); ?>
```




