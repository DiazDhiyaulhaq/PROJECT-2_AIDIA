<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->message;
        $apiKey = env('OPENROUTER_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'openai/gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Kamu adalah asisten kesehatan. Gunakan bahasa sederhana dan boleh pakai emoji seperlunya.'
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ]
        ]);

        $result = $response->json();

        $reply = $result['choices'][0]['message']['content'] ?? 'AI tidak merespon';

        return response()->json([
            'reply' => $reply
        ]);
    }
}