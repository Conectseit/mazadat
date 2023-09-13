<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class MakeActivationCodeExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make-activation_code-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make-activation_code-expired';

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
     */
    public function handle()
    {
        $users = User::where('activation_code' ,'!=',null)->get();
        foreach ($users as $user)
        {
            if(Carbon::parse($user->send_at)->addMinutes(5) < now())
                $user->update(['activation_code'=>null]);
        }
    }
}
