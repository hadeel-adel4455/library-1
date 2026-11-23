<?php

use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('it can list staff', function () {
    Sanctum::actingAs(Staff::factory()->create(), [], 'staff');

    Staff::create([
        'name' => 'Test Staff',
        'email' => 'list@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->getJson('/api/staff');

    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => 'Test Staff',
        ]);
});

test('it can create staff', function () {
    Sanctum::actingAs(Staff::factory()->create(), [], 'staff');

    $response = $this->postJson('/api/staff', [
        'name' => 'New Staff',
        'email' => 'new@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(201);
});

test('it can show one staff member', function () {
    Sanctum::actingAs(Staff::factory()->create(), [], 'staff');

    $staff = Staff::create([
        'name' => 'Show Staff',
        'email' => 'show@example.com',
        'password' => Hash::make('password123'),
    ]);

    $this->getJson('/api/staff/' . $staff->id)
        ->assertStatus(200)
        ->assertJsonPath('data.email', 'show@example.com');
});

test('it can update staff', function () {
    Sanctum::actingAs(Staff::factory()->create(), [], 'staff');

    $staff = Staff::create([
        'name' => 'Old Name',
        'email' => 'update@example.com',
        'password' => Hash::make('password123'),
    ]);

    $this->putJson('/api/staff/' . $staff->id, [
        'name' => 'Updated Name',
    ])->assertStatus(200)
      ->assertJsonPath('data.name', 'Updated Name');
});

test('it can delete staff', function () {
    Sanctum::actingAs(Staff::factory()->create(), [], 'staff');

    $staff = Staff::create([
        'name' => 'Delete Staff',
        'email' => 'delete@example.com',
        'password' => Hash::make('password123'),
    ]);

    $this->deleteJson('/api/staff/' . $staff->id)
        ->assertStatus(200)
        ->assertJsonPath('message', 'Staff deleted successfully');

    $this->assertDatabaseMissing('staff', [
        'id' => $staff->id,
    ]);
});
