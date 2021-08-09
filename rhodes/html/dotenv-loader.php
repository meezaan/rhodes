<?php
// Read .env
try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dotenv->required([
        'ACCESS_TOKEN',
        'SPACE_ID',
        'ENVIRONMENT',

    ]);
} catch (\Dotenv\Exception\InvalidPathException $ex) {
    // Ignore if no dotenv
}
