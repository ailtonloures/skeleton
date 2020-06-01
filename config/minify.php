<?php

if ($_SERVER["SERVER_NAME"] == "localhost") {

    // CSS Minify
    $cssDirName = dirname(__DIR__, 1) . '/templates/assets/css/';
    $cssDir     = dir($cssDirName);
    $minCSS     = new \MatthiasMullie\Minify\CSS();

    while (($file = $cssDir->read()) != false) {
        $cssFile = $cssDirName . $file;

        if (is_file($cssFile) && pathinfo($cssFile)["extension"] == "css") {
            $minCSS->add($cssFile);
        }
    }

    // JS Minify
    $jsDirName = dirname(__DIR__, 1) . '/templates/assets/js/';
    $jsDir     = dir($jsDirName);
    $minJS     = new \MatthiasMullie\Minify\JS();

    while (($file = $jsDir->read()) != false) {
        $jsFile = $jsDirName . $file;

        if (is_file($jsFile) && pathinfo($jsFile)["extension"] == "js") {
            $minJS->add($jsFile);
        }
    }

    $minCSS->minify(dirname(__DIR__, 1) . '/public/assets/style.min.css');
    $minJS->minify(dirname(__DIR__, 1) . '/public/assets/index.min.js');
}
