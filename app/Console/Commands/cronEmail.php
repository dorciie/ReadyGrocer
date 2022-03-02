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
        $checkout = customer::whereBetween('dtdelivery', [$now,$now2])->get();
       
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
        
        //renew dtdelivery based on autodelivery after dtdelivery pass
        $dtnow = \Carbon\Carbon::now();
        $dtnow2 =\Carbon\Carbon::now()->addMinutes(1);
        $dtdelivery = customer::whereBetween('dtdelivery', [$dtnow,$dtnow2])->get();

        foreach($dtdelivery as $dtdelivery){
            if(($dtdelivery->autoDelivery)==='Daily'){
                customer::where('id',$dtdelivery->id)->update(['dtdelivery' => $dtnow->addDays(1)]);}
            elseif(($dtdelivery->autoDelivery)==='Weekly'){
                customer::where('id',$dtdelivery->id)->update(['dtdelivery' => $dtnow->addWeeks(1)]);}
            elseif(($dtdelivery->autoDelivery)==='Fortnight'){
                    customer::where('id',$dtdelivery->id)->update(['dtdelivery' => $dtnow->addWeeks(2)]);}
            elseif(($dtdelivery->autoDelivery)==='Monthly'){
                        customer::where('id',$dtdelivery->id)->update(['dtdelivery' => $dtnow->addMonths(1)]);}  
            else{
                customer::where('id',$dtdelivery->id)->update(['dtdelivery' => NULL]);
            } 
        }

       

    }

}
