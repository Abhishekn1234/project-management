<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusesTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['Pending', 'In Progress', 'Completed', 'On Hold', 'Cancelled'];

        foreach ($statuses as $status) {
            TaskStatus::updateOrCreate(['name' => $status]);
        }
    }
}
