<?php

$container->loadFromExtension('twig', [
    'debug' => "%kernel.debug%",
    'strict_variables' => "%kernel.debug%",
    'globals' => [
        'project' => "%project%",
    ],
    'form_themes' => [
        "foundation_5_layout.html.twig",
        "foundation_6_form_layout.html.twig",
    ],
]);