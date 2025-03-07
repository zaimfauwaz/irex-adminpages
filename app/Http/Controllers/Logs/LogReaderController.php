<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use App\Models\Log;

class LogReaderController extends Controller
{
    public function indexLogs()
    {
        $logs = Log::with('employee')->orderBy('timestamp', 'desc')->orderBy('action', 'asc')->paginate(10); // Fetch logs secara paginate (10 per page)
        return view('adminlogs', compact('logs'));
    }
}
