<?php

namespace App\Http\Controllers\Chatbots;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        if (!Auth::check() || Auth::user()->is_admin) {
            abort(403, 'Unauthorized access');
        }
    }

    public function index()
    {
        return view('messages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

}
