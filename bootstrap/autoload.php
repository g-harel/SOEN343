<?php

use Go\Laravel\GoAopBridge\Src\Kernel\AspectLaravelKernel;

// Initialize an application aspect container
$applicationAspectKernel = AspectLaravelKernel::getInstance();
$applicationAspectKernel->init(array(
        'debug' => true, // Use 'false' for production mode
));
