<div class="wrap">
    <h1>Réseaux sociaux</h1>
    <form method="post" action="options.php">
        <?php settings_fields('m1press_rs'); ?>
        <?php do_settings_sections('m1press_rs'); ?>
        <?php submit_button(); ?>
    </form>
</div>