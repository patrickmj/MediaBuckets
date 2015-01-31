<?php
$pageTitle = __('Browse Media Buckets');
echo head(
    array(
        'title' => $pageTitle,
        'bodyclass' => 'items browse'
    )
);
echo flash();
echo item_search_filters();
?>

<?php
set_loop_records('item', $buckets);
?>
<?php foreach (loop('item') as $item): ?>
<div>
<h2><?php echo link_to($item, 'edit', metadata($item, array('Dublin Core', 'Title'))); ?></h2>

<?php 
echo item_image_gallery(
        array('linkWrapper' => array('class' => 'admin-thumb panel')),
        'square_thumbnail', true);

?>

</div>

<?php endforeach; ?>

<?php echo foot(); ?>