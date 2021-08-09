<?php

namespace App\Console\Commands;
use App\Models\customer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Checkout:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Confirm your checkout';

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
        $now =\Carbon\Carbon::now()->addHours(1);
        $now2=\Carbon\Carbon::now()->addHours(1)->addMinutes(1);
        // $checkout = customer::where('dtdelivery', '<=', $now)
        // '2021-06-20 22:30:00'
        $checkout = customer::whereBetween('dtdelivery', [$now,$now2])
        ->get();
       
        foreach($checkout as $checkout){
            Mail::send(
                'customer.email.checkoutConfirmation',
                ['customer'=> $checkout],
                function($message) use ($checkout){
                    $message->to($checkout->email);
                    $message->subject("$checkout->name, Confirm you checkout");
                }
            );
        }
    }

}
