<?php

use App\Models\Chat;
use App\Models\User;

test('chat belongs to a user', function () {
    // Given
    $user = User::factory()->create(['name' => 'Sam Nel']);

    $chat = Chat::factory()->create(['user_id' => $user->id]);

    // When
    $author = $chat->user;

    // Assert
    expect($author)->toBeInstanceOf(User::class);

    expect(($user->id))->toBe($author->id);

});

test('user can have many chats', function () {
    // Given
    $user = User::factory()->create(['name' => 'Sam Nel']);

    $chat = Chat::factory()->count(4)->create(['user_id' => $user->id]);

    // When
    $authorChats = $user->chats()->get();

    // Assert
    expect($authorChats)->toHaveCount(4);

});
