<?php

namespace App\Helpers;

use App\Models\Task;

class PointSystem
{
    public static function calculatePoints(Task $task): int
    {
        $points = 10;

        if ($task->priority === 'high') {
            $points += 20;
        }

        if ($task->deadline && $task->deadline->isFuture()) {
            $points += 5;
        }

        if ($task->subtasks && $task->subtasks->isNotEmpty()) {
            $points += 5;
        }

        return $points;
    }

    public static function checkForBadges(int $totalPoints): array
    {
        $badges = [];

        if ($totalPoints >= 50) {
            $badges[] = 'Task Master Badge';
        }
        if ($totalPoints >= 100) {
            $badges[] = 'Productivity Star Badge';
        }
        if ($totalPoints >= 150) {
            $badges[] = 'Goal Crusher Badge';
        }
        if ($totalPoints >= 200) {
            $badges[] = 'Ultimate Achiever Badge';
        }

        return $badges;
    }
}

