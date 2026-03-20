<?php

declare(strict_types=1);

/**
 * Example: parsing a simple template with the Lex template parser.
 *
 * Run from the lex project root:
 *   php examples/parse_template.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Lex\Parser;

$parser = new Parser();

// --- Basic variable interpolation ---
$template = 'Hello, {{ name }}! You have {{ count }} messages.';
$data = ['name' => 'Alice', 'count' => 5];

$output = $parser->parse($template, $data);
echo $output . "\n";

// --- Nested (dot-notation) variables ---
$template2 = 'User: {{ user.first }} {{ user.last }} ({{ user.email }})';
$data2 = [
    'user' => [
        'first' => 'Bob',
        'last'  => 'Smith',
        'email' => 'bob@example.com',
    ],
];

echo $parser->parse($template2, $data2) . "\n";

// --- Loop block ---
$template3 = <<<LEX
Items:
{{ items }}
  - {{ value }}
{{ /items }}
LEX;

$data3 = [
    'items' => [
        ['value' => 'Apple'],
        ['value' => 'Banana'],
        ['value' => 'Cherry'],
    ],
];

echo $parser->parse($template3, $data3);

// --- Callback tag ---
$template4 = 'Result: {{ math:double value="7" }}';
$callback = static function (string $name, array $attributes): string {
    if ($name === 'math:double') {
        return (string)((int)$attributes['value'] * 2);
    }
    return '';
};

echo $parser->parse($template4, [], $callback) . "\n";
