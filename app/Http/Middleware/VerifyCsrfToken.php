<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'patients/photos/upload_images',
        'patients/photos/update_images',
        'patients/photos/delete_image',
        'patients/export/photo/*',
        'patients/import/photo',
    ];
}
