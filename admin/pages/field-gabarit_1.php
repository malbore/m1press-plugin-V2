<?php
    $option = get_option($args['label_for']);
    if(isset($option[$args['slug']])) {
        $return = [
            'title' => $option[$args['slug']]['title'],
            'content' => $option[$args['slug']]['content'],
        ];
    } else {
        $return = [
            'title' => 'Ajouter un titre ici',
            'content' => 'Ajouter un contenu html ici',
        ];
    }
?>
<input class="regular-text" type="text" name="<?= $args['label_for'] ?>[<?= $args['slug'] ?>][title]" value="<?= $return['title'] ?>" placeholder="Titre du gabarit" />
<div class="container-codemirror">
    <h4>Ajouter un shortcode : </h4>
        <ul>
        <?php foreach($args['data'] as $shortcode) : ?>
            <li style="display:inline-block;">
                <button class="shortcode_button" data-add="<?= $args['label_for'] . '-' . $args['slug']  ?>"  value="<?= $shortcode ?>"><?= $shortcode ?></button>
            </li>
        <?php endforeach; ?>
        </ul>
    <textarea class="coder" name="<?= $args['label_for'] ?>[<?= $args['slug'] ?>][content]" id="<?= $args['label_for'] . '-' . $args['slug']  ?>" cols="30" rows="10"><?= $return['content'] ?></textarea>
</div>