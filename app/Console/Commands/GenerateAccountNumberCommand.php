<?php

namespace App\Console\Commands;

use App\Models\Wallet;
use Illuminate\Console\Command;

class GenerateAccountNumberCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:generate {user? : The ID of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Users Account No';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        $userID = $this->argument('user');
        if ($userID !== null) {
            $this->info('fetching user account');
            $wallet = Wallet::whereUserId($userID)->first();

            if ($wallet !== null) {
                if ($wallet->account_no !== null) {
                    $this->error("This user already have an account number");
                    return;
                }
                $account_no = generate_account_no();
                $wallet->account_no = $account_no;
                $wallet->save();

                $this->alert("Account No added Successfully");

            } else {
                $this->error("User wallet not found");
            }
        } else {
            $this->info("Loading empty account numbers");
            $wallets = Wallet::whereNull('account_no')->get();
            $this->info("wallets found :" . $wallets->count());

            foreach ($wallets as $wallet) {
                $account_no = generate_account_no();
                $wallet->account_no = $account_no;
                $wallet->save();

            }

            $this->alert('Done');

        }

    }
}
