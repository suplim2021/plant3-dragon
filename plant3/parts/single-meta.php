<?php
$cats = plant_cats();
$tags = plant_tags();
if (!$cats && !$tags) {
    return;
}
?>
<div class="single-meta">
    <?php echo $cats . $tags; ?>
</div>