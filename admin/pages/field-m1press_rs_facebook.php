<?php
$option = get_option($args['label_for']);
?>

<?php 
if (isset($option[$args['slug']]) && $option[$args['slug']]) : 
?>
    <input class="regular-text" type="text" name="<?= $args['label_for'] ?>[<?= $args['slug'] ?>]" value="<?= $option[$args['slug']] ?>" placeholder="Url du réseau" /><br>
    Shortcode : <input type="text" value="<?= $args['data'] ?>" readonly>
<?php else : ?>
    <input class="regular-text" type="text" name="<?= $args['label_for'] ?>[<?= $args['slug'] ?>]" value="" placeholder="Url du réseau" />
<?php endif; ?>


