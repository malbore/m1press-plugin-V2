<?php
$option = get_option($args['label_for']);

?>
<?php if (isset($option[$args['slug']]) && $option[$args['slug']]) : ?>
    <input class="regular-text" type="checkbox" name="<?= $args['label_for'] ?>[<?= $args['slug'] ?>]" checked />
<?php else : ?>
    <input class="regular-text" type="checkbox" name="<?= $args['label_for'] ?>[<?= $args['slug'] ?>]" />
<?php endif; ?>