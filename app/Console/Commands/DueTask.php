<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tasks;
use Illuminate\Support\Facades\Mail;
use App\Mail\DueTask as MailTask;
use Carbon\Carbon;

class DueTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:due-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task is running out of time';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $now = Carbon::now();
        $twentyFourHoursFromNow = $now->copy()->addHours(24);
        $tasks = Tasks::with('user:id,email')->whereBetween('duedate', [$now, $twentyFourHoursFromNow])->get();

        if ($tasks->count() > 0) {
            foreach ($tasks as $task) {
                try {
                    Mail::to($task->user->email)->send(new MailTask($task));
                } catch (\Exception $e) {
                    info($e);
                }
            }
        }

        return 0;
    }
}
