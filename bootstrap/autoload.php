<?php

// Initialize an application aspect container
$applicationAspectKernel = AspectLaravelKernel::getInstance();
$applicationAspectKernel->init(array(
        'debug' => true, // Use 'false' for production mode
        // Cache directory
        'cacheDir' => '../aop/app/storage/cache/', // Adjust this path if needed
));
