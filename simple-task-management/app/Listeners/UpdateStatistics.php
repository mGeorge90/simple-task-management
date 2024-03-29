<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Models\Statistics;
use http\Client\Curl\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create the event listener.
     */
    public function __construct(TaskCreated $event)
    {
        $this->userId = $event->userId;
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCreated $event): void
    {
        $user  = User::find($event->userId);
        $isUserHasTasks = @$user->tasks()->count() > 0;
        if ($user && $isUserHasTasks) {
            $statistics = Statistics::where('user_id', $user->id)->first();
            if ($statistics) {
                $statistics->update([
                    'task_count' => $statistics->task_count + 1
                ]);
            } else {
                Statistics::create([
                    'user_id' => $user->id,
                    'task_count' => $user->tasks()->count()
                ]);
            }
        }

    }
}
