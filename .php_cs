<?php

$author = '@author Marc MOREAU <moreau.marc.web@gmail.com>';
$license = '@license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT';
$link = '@link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md';

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->in(__DIR__)
;

$config = PhpCsFixer\Config::create()
    ->setRiskyAllowed(false)
    ->setRules([
        '@PhpCsFixer' => true,
        'php_unit_test_class_requires_covers' => false,
        'header_comment' => [
            'header' => implode("\n", [$author, $license, $link]),
            'comment_type' => 'PHPDoc',
        ],
    ])
    ->setFinder($finder)
;

return $config;
