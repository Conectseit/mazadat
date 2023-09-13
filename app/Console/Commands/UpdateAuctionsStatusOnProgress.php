<?php

namespace App\Console\Commands;

use App\Models\Auction;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateAuctionsStatusOnProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:update_status_on_progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update auction status on progress after start_date';

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
//        return 0;
        $auctions = Auction::where('status','not_accepted')
            ->where('is_accepted','1')->where('start_date' ,'<=', Carbon::now())->get();
        foreach ($auctions as $auction)
        {
            if($auction->start_date <= Carbon::now()){

                $auction->update(['status'=>'on_progress']);
            }
        }
    }
}
