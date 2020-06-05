<?php
declare(strict_types=1);

use DI\ContainerBuilder;
/**
 * This is dependancy injection for formating data
 */
return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'formatUtil' => new \App\Common\FormatUtil(),
        'salesDatabase' => new \App\Common\SalesDatabase()
    ]);
};
