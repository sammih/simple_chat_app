<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\Chat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Response
    {
        // Retrieve the latest chat messages with associated users
        return Inertia::render('Chats/Index', [
            'chats' => Chat::with('user:id,name')
            ->latest() // Order by the latest messages
            ->get() // Fetch the results
        ]);
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
    public function store(StoreChatRequest $request) : RedirectResponse
    {
        // Create a new chat message for the authenticated user
        auth()->user()->chats()->create($request->safe()->only(['message']));

        return  redirect(route('chats.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat) : RedirectResponse
    {
        $this->authorize('update', $chat);

        $chat->update($request->safe()->only(['message']));

        return  redirect(route('chats.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat) : RedirectResponse
    {
        $this->authorize('delete', $chat);

        $chat->delete();

        return redirect(route('chats.index'));
    }
}
