<?php
require PLUGIN_PATH . 'updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/malbore/m1press-plugin-v2/',
    __FILE__,
    'm1press-plugin-v2'
);
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');
