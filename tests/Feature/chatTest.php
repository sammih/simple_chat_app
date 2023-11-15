<?php

use App\Models\Chat;
use App\Models\User;
use App\Policies\ChatPolicy;

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

test('user can update own chat', function () {
    $user = User::factory()->create();
    $chat = Chat::factory()->create(['user_id' => $user->id]);

    $chatPolicy = new ChatPolicy();

    expect($chatPolicy->update($user, $chat))->toBeTrue();
});

test('user cannot update other users chat', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $chat = Chat::factory()->create(['user_id' => $user1->id]);

    $chatPolicy = new ChatPolicy();

    expect($chatPolicy->update($user2, $chat))->toBeFalse();
})->only();

test('user can delete own chat', function () {
    $user = User::factory()->create();
    $chat = Chat::factory()->create(['user_id' => $user->id]);

    $chatPolicy = new ChatPolicy();

    expect($chatPolicy->delete($user, $chat))->toBeTrue();
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

    $user = User::factory()->create();

    $this->actingAs($user); // SigningIn a user

    $chat = Chat::factory()->create(['user_id' => $user->id]);

    $response = $this->delete(route('chats.destroy', $chat));

    $response->assertStatus(302);

    $this->assertDatabaseMissing('chats', [
        'id' => $chat->id
    ]);
});
