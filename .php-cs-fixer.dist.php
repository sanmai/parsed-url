<?php

declare(strict_types=1);

$header = trim(sprintf(
    'This code is licensed under the MIT License.%s',
    substr(
        file_get_contents('LICENSE'),
        strlen('The MIT License (MIT)')
    )
));

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP70Migration:risky' => true,
        '@PHP71Migration:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'declare_strict_types' => true,
        'explicit_indirect_variable' => true,
        'no_superfluous_elseif' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => false,
        'non_printable_character' => true,
        'ordered_imports' => true,
        'php_unit_test_class_requires_covers' => true,
        'php_unit_strict' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_order' => true,
        'visibility_required' => true,
        'header_comment' => ['header' => $header, 'separate' => 'bottom', 'location' => 'after_open', 'comment_type' => 'PHPDoc'],
        'ternary_to_null_coalescing' => true,
        'yoda_style' => true,
        'phpdoc_to_comment' => false,
        'strict_comparison' => true,
        'is_null' => true,
        'function_to_constant' => true,
        'void_return' => false,
        'return_assignment' => true,
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'native_function_invocation' => false,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
        ->in(__DIR__)
    )
;

return $config;
