<?php

namespace tests\Feature;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_list_tasks(): void
    {
        $response = $this->get('/api/tasks');

        $response->assertStatus(200);
    }

    public function test_create_task(): void
    {
        $response = $this->post('/api/tasks', [
            'title' => 'Test task',
            'description' => 'Test task description',
            'assigned_to_id' => 1,
            'assigned_by_id' => 1
        ]);

        $response->assertStatus(201);
    }
}
