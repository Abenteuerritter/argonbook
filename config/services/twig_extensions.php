<?php

$container->register('argon.twig_extension.markdown', [
    'class' => Argon\Twig\Extension\MarkdownExtension::class,
    'arguments' => [
        ['type' => 'service', 'id' => 'cebe.markdown']
    ],
    'tags' => ['twig.extension'],
]);
