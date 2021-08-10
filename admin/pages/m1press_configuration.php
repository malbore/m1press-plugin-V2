<div class="wrap">
    <h1>Configuration globale</h1>
    <form method="post" action="options.php">
        <?php settings_fields('m1press_configuration'); ?>
        <?php do_settings_sections('m1press_configuration'); ?>
        <?php submit_button(); ?>
    </form>
</div>