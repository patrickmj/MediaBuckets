<?php

echo head();

?>

<?php 
$collection = get_record_by_id('collection', 119);

$files = media_buckets_record_files($collection);
$image = media_buckets_record_image($collection);
$gallery = media_buckets_record_gallery($collection);

//echo $image;
echo $gallery; 

?>





<?php 

echo foot();
?>