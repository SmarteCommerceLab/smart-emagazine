<?php

$support = file_get_contents(dirname(__DIR__) . '/lib/theme-support.php');

foreach (array(
    "add_theme_support('smart-builder-site'",
    "'smart-site-home.php' => array('builder' => true, 'compose' => true)",
    "'smart-site-blog.php' => array('builder' => true, 'compose' => true)",
    "'smart-site-builder.php' => array('builder' => true, 'compose' => false)",
) as $needle) {
    if (false === strpos($support, $needle)) {
        fwrite(STDERR, "Missing SBS capability: {$needle}\n");
        exit(1);
    }
}

echo "Smart eMagazine SBS capabilities contract OK\n";
