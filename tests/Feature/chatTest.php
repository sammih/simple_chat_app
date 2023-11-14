<?php

use App\Models\Chat;
use App\Models\User;

test('chat can be created by posting to a route', function () {

    $user = User::factory()->create();

    $this->actingAs($user);

    $input = Chat::factory()->make(['user_id' => $user->id]);

    $this->post(route('chats.store'), $input->toArray());

    expect($input->message)->toBe($input->message);

    $this->assertDatabaseHas('chats', [
        'message' => $input->message
    ]);
});

test('chat can be updated by posting to a route', function () {

    $user = User::factory()->create();

    $this->actingAs($user);

    $originalInput = Chat::factory()->create(['user_id' => $user->id]);

    expect($originalInput->message)->toBe($originalInput->message);

    $this->assertDatabaseHas('chats', [
        'message' => $originalInput->message
    ]);

    $updatedInput = Chat::factory()->make(['message' => 'updated test message']);

    $this->put(route('chats.update', $originalInput), $updatedInput->toArray());

    $this->assertDatabaseHas('chats', [
        'message' => $updatedInput->message
    ]);

});

test('chat can be deleted by posting to a route', function () {
    $this->withoutExceptionHandling();

    $user = User::factory()->create();

    $this->actingAs($user); // SigningIn a user

    $chat = Chat::factory()->create(['user_id' => $user->id]);

    $response = $this->delete(route('chats.destroy', $chat));

    $response->assertStatus(302);

    $this->assertDatabaseMissing('chats', [
        'id' => $chat->id
    ]);
});
