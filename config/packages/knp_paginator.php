<?php

$container->loadFromExtension('knp_paginator', [
    'page_range' => 15,
    'template' => [
        'pagination' => "foundation_6_pagination.html.twig",
    ],
]);