<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'items/computer/desktop/delete',
        'items/computer/tablet/delete',
        'items/computer/laptop/delete',
        'items/computer/desktop/modify',
        'items/computer/tablet/modify',
        'items/computer/laptop/modify',
        'items/monitor/delete',
        'items/monitor/modify',
        'items/computer/desktop/addDesktopUnits',
        'items/computer/tablet/addTabletUnits',
        'items/computer/laptop/addLaptopUnits',
        'view/items/monitor/reserve',
        'view/items/desktop/reserve',
        'view/items/laptop/reserve',
        'view/items/tablet/reserve'
    ];
}
