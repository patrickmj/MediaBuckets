# MediaBuckets
Omeka plugin that allows Items of type "MediaBucket' to be a (optionally) sequestered bucket for media for use elsewhere.

## Background

WordPress users are often stymied be not having a media upload, for uploading file to incorporate elsewhere. In the Omeka model, all files uploaded are attached to Omeka Items. But, sometimes files are not properly understood as Items in Omeka.

The standard workaround has been to upload files as items, then pull in the files ignoring the items. That works, but raised questions about "What is an Item in Omeka, anyway?".

This plugin is an attempt to mitigate that pain.

## Usage

The plugin creates a new Item Type in Omeka calles "MediaBucket". The intent of that Item Type is to be a repository (or, bucket) for files to use elsewhere in publishing, but might not be 'real' Items in your Omeka site. The only useful thing that it does is block items of type "MediaBucket" from showing up in the item browse and other pages. That's optional in the configuration. 

If you want to upload some files that are not really attached to anything, pretend by creating a new Item with Type "MediaBucket". Add all the file you want to that. Use shortcodes to stuff them into your pages.

As a convenience, the plugin also adds some functions for displaying media at random places. This isn't actually new functionality -- it could be done easily with core functions -- but if it makes life easier, here it is.
