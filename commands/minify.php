<?php

require __DIR__ . '/../vendor/autoload.php';

try {

    $argument = $argv[1]; // all-for-one or one-for-one

    if (isset($argument)) {
        // Path for CSS
        $cssDirName = dirname(__DIR__, 1) . '/templates/assets/css/';
        $cssDir     = dir($cssDirName);
        // Path for JS
        $jsDirName = dirname(__DIR__, 1) . '/templates/assets/js/';
        $jsDir     = dir($jsDirName);

        if ($argument == "all-for-one") {

            $minCSS = new \MatthiasMullie\Minify\CSS();
            $minJS  = new \MatthiasMullie\Minify\JS();

            // CSS Minify
            while (($file = $cssDir->read()) != false) {
                $cssFile = $cssDirName . $file;

                if (is_file($cssFile) && pathinfo($cssFile)["extension"] == "css") {
                    $minCSS->add($cssFile);
                }
            }

            // JS Minify
            while (($file = $jsDir->read()) != false) {
                $jsFile = $jsDirName . $file;

                if (is_file($jsFile) && pathinfo($jsFile)["extension"] == "js") {
                    $minJS->add($jsFile);
                }
            }

            $minCSS->minify(dirname(__DIR__, 1) . '/public/assets/style.min.css');
            $minJS->minify(dirname(__DIR__, 1) . '/public/assets/index-min.js');

        } else if ($argument == "one-for-one") {
            // CSS Minify
            while (($file = $cssDir->read()) != false) {
                $cssFile = $cssDirName . $file;

                if (is_file($cssFile) && pathinfo($cssFile)["extension"] == "css") {
                    $minCSS = new \MatthiasMullie\Minify\CSS();
                    $minCSS->add($cssFile);
                    $minCSS->minify(dirname(__DIR__, 1) . '/public/assets/' . pathinfo($cssFile)["filename"] . '.min.css');
                }
            }

            // JS Minify
            while (($file = $jsDir->read()) != false) {
                $jsFile = $jsDirName . $file;

                if (is_file($jsFile) && pathinfo($jsFile)["extension"] == "js") {
                    $minJS = new \MatthiasMullie\Minify\JS();
                    $minJS->add($jsFile);
                    $minJS->minify(dirname(__DIR__, 1) . '/public/assets/' . pathinfo($jsFile)["filename"] . '-min.js');
                }
            }
        }
    }

    echo "...\n\nAll files were minified and saved to public/assets\n\n...";

} catch (\Exception $exception) {
    echo "...\n\n{$exception->getMessage()}\n\n...";
}
