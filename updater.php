<?php
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/malbore/m1press-plugin/',
    __FILE__,
    'm1press-plugin'
);
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');
$myUpdateChecker->setAuthentication('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');