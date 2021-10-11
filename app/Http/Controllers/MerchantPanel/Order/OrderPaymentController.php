<?php

namespace App\Http\Controllers\MerchantPanel\Order;

use App\Constant\OrderPaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\OrderAssignment;
use App\Models\Statement;
use App\Models\Transaction;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderPaymentController extends Controller
{
    public function payment(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // exit();

        try {

            $orderAssignment = OrderAssignment::where('id', $request->orderAssignmentId)
                ->with(['order'])
                ->first();

            if (!$orderAssignment) {
                $request->session()->flash('error_alert', 'Order dose not exist.');
                return redirect()->back();
            }

            $sender = UserAccount::where('user_id', $orderAssignment->assigned_by_id)
                ->lockForUpdate()
                ->first();

            if (!$sender) {
                $request->session()->flash('error_alert', 'Sender account not found.');
                return redirect()->back();
            }

            $receiver = UserAccount::where('user_id', $orderAssignment->assigned_to_id)
                ->lockForUpdate()
                ->first();

            if (!$sender) {
                $request->session()->flash('error_alert', 'Receiver account not found.');
                return redirect()->back();
            }

            DB::transaction(function () use ($orderAssignment, $sender, $receiver) {

                $tx_unique_id = bin2hex(random_bytes(5));
                while (true) {
                    $transaction = Transaction::where('tx_unique_id', $tx_unique_id)->first();
                    if (!$transaction) {
                        break;
                    }
                    $tx_unique_id = bin2hex(random_bytes(5));
                }

                $service_charge = $orderAssignment->service_charge + $orderAssignment->area_charge + $orderAssignment->weight_charge + $orderAssignment->delivery_type_charge;

                // transaction create
                $transaction = Transaction::create([
                    'tx_unique_id' => $tx_unique_id,
                    'order_id' => $orderAssignment->order->order_id,
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    // 'transaction_type_id' =>
                    // 'transaction_status_id' =>
                    'amount' => $orderAssignment->order->amount,
                    'sender_service_charge' => $service_charge,
                ]);

                $transaction->total_amount = ceil($transaction->amount + $transaction->sender_service_charge);
                $transaction->save();

                // sender statement
                Statement::create([
                    'transaction_id' => $transaction->id,
                    'user_id' => $sender->id,
                    'description' => $transaction->total_amount . ' BDT debited from ' . $sender->account_no . ' account.',
                    'debit' => $transaction->total_amount,
                    'current_balance' => $sender->balance - $transaction->total_amount,
                ]);

                // receiver statement
                Statement::create([
                    'transaction_id' => $transaction->id,
                    'user_id' => $receiver->id,
                    'description' => 'Account ' . $receiver->account_no . ' credited by ' . $transaction->total_amount . ' BDT',
                    'credit' => $transaction->total_amount,
                    'current_balance' => $receiver->balance + $transaction->total_amount,
                ]);

                $receiver->increment('balance', $transaction->total_amount);

                $sender->decrement('balance', $transaction->total_amount);

                // $orderAssignment->payment = OrderPaymentStatus::PAID;
                $orderAssignment->payment = 'PAID';

                $orderAssignment->save();
            });

            $request->session()->flash('success_alert', 'Payment payed successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
