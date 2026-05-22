<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"    => "required|string|max:255",
            "email"   => "required|email|max:255",
            "phone"   => "nullable|string|max:20",
            "subject" => "nullable|string|max:255",
            "message" => "required|string",
        ]);

        $message = Message::create($validated);

        Notification::route("mail", "bwadikabeugnare@gmail.com")
            ->notify(new NewMessageNotification($message));

        return response()->json([
            "success" => true,
            "message" => "Votre message a ete envoye avec succes.",
            "data"    => $message,
        ], 201);
    }
}