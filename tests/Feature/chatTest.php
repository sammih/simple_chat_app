<?php

use App\Models\Chat;
use App\Models\User;

test('chat can be created', function () {
    $this->withoutExceptionHandling();

    $this->actingAs(User::factory()->create());
    
    $input = Chat::factory()->make();

    $this->post(route('chats.store'), $input->toArray());

    expect($input->message)->toBe($input->message);

    $this->assertDatabaseHas('chats', [
        'message' => $input->message
    ]);
});
