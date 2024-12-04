<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_task(): void
    {
        $user = User::factory()->create();
    
        $this->actingAs($user);
    
        $task = Task::factory()->make(); 
    
        $response = $this->post(route('tasks.store'), $task->toArray());
    
        $response->assertStatus(302); 
        $this->assertDatabaseHas('tasks', ['title' => $task->title, 'user_id' => $user->id]);
    }
    

    public function test_user_can_delete_a_task(): void
    {
        $user = User::factory()->create();
    
        $this->actingAs($user);
    
        $task = Task::factory()->create(['user_id' => $user->id]); 
    
        $response = $this->delete(route('tasks.destroy', $task->id));
    
        $response->assertStatus(302); 
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
    
}
