<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LookFile implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $file_id;
    private $user_id;
    private $group_id;
    public function __construct($file_id, $user_id, $group_id)
    {
        $this->file_id = $file_id;
        $this->user_id = $user_id;
        $this->group_id = $group_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // $file = File::find($this->file_id);
        // $lockKey = 'file:' . $file->id . ':field_lock';
        //$lockValue = 'locked';
        DB::table('reports')->insert([
            'report' => "check_out",
            'user_id' => $this->user_id,
            'file_id' => $this->file_id,
            'group_id' => $this->group_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
