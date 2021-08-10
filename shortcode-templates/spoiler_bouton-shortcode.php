<?php
$classes = ['spoiler-bouton'];
if (isset($atts['add_class']))
    array_push($classes, $atts['add_class']);

$data = [];
if($texte_bouton_open) 
    array_push($data, "data-open=\"{$texte_bouton_open}\"");
if($texte_bouton_close) 
    array_push($data, "data-close=\"{$texte_bouton_close}\"");

$data = implode(' ', $data);
?>
<button class="<?php echo implode(' ', $classes); ?>" <?= $data ?> >
<?php
    if($texte_bouton_open)
        echo $texte_bouton_open;
?>
</button>