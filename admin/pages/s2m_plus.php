<div class="wrap">
    <h1 class="wp-heading-inline">Bonne pratiques pour modifier mon site</h1>
</div>
<?php 
$guidelines = get_template_directory() . '/guidelines.html';
if(is_readable($guidelines))
    echo file_get_contents($guidelines);
else
    echo 'Pour ajouter des guidelines veillez à créer un fichier guidelines.html à la racine de votre thème';
?>