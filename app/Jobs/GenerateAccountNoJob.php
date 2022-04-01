<?php

namespace App\Jobs;

use App\Models\Wallet;
use Artisan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class GenerateAccountNoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Wallet
     */
    public $wallet;

    public $tries = 3;
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $exitCode = Artisan::call('account:generate', [
            'user' => $this->wallet->user_id
        ]);

        Log::info('command exit with code :' . $exitCode);
    }
}
