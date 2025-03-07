<?php

namespace App\Listeners;

use App\Http\Controllers\Logs\LogAccessController;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Str;

class LogAccessListener
{
    public function handle(RequestHandled $event)
    {
        $request = $event->request;
        $path = $request->path();
        if ($this->filterTypes($path)) {return;}
        $logController = app(LogAccessController::class);
        $logController->logAccessWeb($request);
    }

    private function filterTypes(string $path): bool
    {
        $excludedPaths = [
            'assets/*',
            'css/*',
            'js/*',
            'fonts/*',
            'images/*',
            'favicon.ico',
            '*.*',
        ];

        foreach ($excludedPaths as $excluded) {
            if (fnmatch($excluded, $path)) {
                return true; // Skip logging
            }
        }

        if (Str::startsWith($path, ['assets/', 'css/', 'js/', 'images/'])) {
            return true;
        }

        return false;
    }
}

