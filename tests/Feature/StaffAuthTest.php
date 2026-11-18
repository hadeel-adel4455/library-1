<?php

use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('staff can login with correct credentials', function () {
    $staff = Staff::factory()->create([
        'password' => '12345678',
    ]);

    $response = $this->postJson('/api/staff/login', [
        'email' => $staff->email,
        'password' => '12345678',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'token',
        ]);
});

test('staff cannot login with wrong password', function () {
    $staff = Staff::factory()->create([
        'password' => '12345678',
    ]);

    $response = $this->postJson('/api/staff/login', [
        'email' => $staff->email,
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(401);
});

test('staff can logout', function () {
    $staff = Staff::factory()->create();

    $token = $staff->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->postJson('/api/staff-logout');

    $response->assertStatus(200);
});

test('staff cannot access protected route without token', function () {
    $response = $this->getJson('/api/staff-me');

    $response->assertStatus(401);
});