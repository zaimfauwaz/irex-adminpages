<?php

namespace App\Http\Controllers;

use App\Models\Playground;
use App\Models\PlaygroundInquiry;
use App\Services\Laravel\SessionManagerService;
use App\Services\OpenAI\MessageProcessorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaygroundController extends Controller
{
    protected $sessionService;
    protected $messageProcessorService;

    public function __construct(SessionManagerService $sessionService, MessageProcessorService $messageProcessor)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access');
        }
        $this->sessionService = $sessionService;
        $this->messageProcessorService = $messageProcessor;
    }

    public function index()
    {
        $userId = auth()->id();


        $playgrounds = Playground::withCount('inquiries')->where('employee_id', $userId)->orderBy('created_at', 'desc')->paginate(10);
        return view('playground.index', compact('playgrounds'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $playgroundId = $request->input('playground_id');

        // Get or start session
        $session = Playground::where('employee_id', $userId)
            ->where('playground_id', $playgroundId)
            ->whereNull('deleted_at')
            ->first();

        if (!$session || $this->sessionService->checkTimeout($playgroundId)) {
            if ($session) {
                $this->sessionService->stopSession($playgroundId);
            }

            $session = $this->sessionService->startSession(); // new one
            $playgroundId = $session->playground_id;
        }

        $prompt = $request->input('pg-prompt');

        $message = [
            'text' => $prompt,
            'instruction' => 'You are a helpful and professional customer support assistant. Based on the provided product and FAQ data, answer the user’s question, and provide them a personalized customer service experience. Do not make up data not included in the results, and please do not give answers for something out of topic or domain.',
            'model' => 'gpt-4o-mini'
        ];

        $result = $this->messageProcessorService->processMessageSearch($message);

        PlaygroundInquiry::create([
            'playground_id' => $playgroundId,
            'prompt' => $prompt,
            'result' => $result,
        ]);

        $inquiries = PlaygroundInquiry::where('playground_id', $playgroundId)
            ->orderBy('created_at')
            ->get();

        return response()->json([
            'inquiries' => $inquiries,
            'playground_id' => $playgroundId
        ]);
    }

    public function show($playground_id)
    {
        $playground = Playground::findOrFail($playground_id);
        return view('playground.show', compact('playground'));
    }

    public function destroy(Playground $playground)
    {
        $playground->delete();
        return redirect()->route('playground.index');
    }
}
