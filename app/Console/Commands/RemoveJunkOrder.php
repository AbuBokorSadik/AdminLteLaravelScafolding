<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderAssignment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Console\Command;

class RemoveJunkOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'junk-order:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For remove junk orders.';

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
        $start_date_time = now()->subMonth()->setTime(0, 0, 0)->format('Y-m-d H:i:s');
        $end_date_time = now()->subMonth()->setTime(23, 59, 59)->format('Y-m-d H:i:s');


        $orders = Order::whereHas('orderAssignment', function (Builder $query) {
            $query->has('orderAssignmentActivity', 'task');
        })
            ->whereBetween('created_at', [$start_date_time, $end_date_time])
            ->get();

        foreach ($orders as $order) {
            if ($order->delete()) {
                OrderAssignment::where('order_id', $order->id)
                    ->delete();
            }
        }
    }
}
