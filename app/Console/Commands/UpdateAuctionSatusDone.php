<?php

namespace App\Console\Commands;

use App\Models\Auction;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateAuctionSatusDone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:update_status_done';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update auction status after end_date';

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
        //return Command::SUCCESS;
//        )
        $on_progress_auctions = Auction::where('status', 'on_progress')->get();
        foreach ($on_progress_auctions as $on_progress_auction) {

            if ($on_progress_auction->end_date <= Carbon::now()) {

                $on_progress_auction->update(['status' => 'done']);
            }
        }

    }
}
