<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'transaction_no' => strtoupper(uniqid()),
            'type' => "Transfer",
            'amount' => $request['amount'],
            'account_no' => $request['account_no'],
            'status' => "Pending",
            'contact_email' => $request['contact_email'],
        ]);
        return view('confirmation')->with('transaction', $transaction);
    }

    public function indexOptions()
    {
        return view('transfer', ['user' => request()->user()]);
    }

    public function indexIncoming()
    {
        return view('transfers/incoming', ['transactions' => request()->user()->transactions->where('status', 'Pending')->where('type', 'Deposit')]);
    }

    public function indexOutgoing()
    {
        return view('transfers/outgoing', ['transactions' => request()->user()->transactions->where('status', 'Pending')->where('type', 'Transfer')->sortByDESC('updated_at')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $tr = Transaction::find($id);

        if ($tr->type == "Transfer") {  // IF UPDATE MADE BY SENDER:

            // The sender wants to cancel the transaction
            $sender_tr = $tr;
            $receiver_tr = Transaction::where('transaction_no', $sender_tr->transaction_no)->firstWhere('id', '!=', $id);

            $created_sec_ago = Carbon::now()->diffInSeconds($sender_tr->created_at);
            if ($created_sec_ago < 2 * 60 * 60) {
                // allow sender to cancel transaction
                $sender_tr->status = "Canceled";
                $receiver_tr->status = "Canceled";
                $sender_tr->account->balance += $sender_tr->amount;

                $sender_tr->save();
                $receiver_tr->save();

                return redirect('transfers/pending/outgoing');
            } else {
                $message = "Sorry, a transaction that is older than 2 hours cannot be cancelled";
                return redirect('transfers/pending/outgoing')->with('message', $message);
            }
        } else {    // IF UPDATE MADE BY RECEIVER:
            $receiver_tr = Transaction::find($id);
            $sender_tr = Transaction::where('transaction_no', $receiver_tr->transaction_no)->firstWhere('id', '!=', $id);

            if ($request['action'] == "accept") {

                // The receiver accepts the transaction
                $sender_tr->status = "Completed";
                $receiver_tr->status = "Completed";

                Account::where('account_no', $receiver_tr->account_no)->update(['balance' => $receiver_tr->account->balance += $receiver_tr->amount]);
            } else if ($request['action'] == "decline") {

                // The receiver declines the transaction
                $sender_tr->status = "Canceled";
                $receiver_tr->status = "Canceled";
                Account::where('account_no', $sender_tr->account_no)->update(['balance' => $sender_tr->account->balance += $sender_tr->amount]);
            }
            $sender_tr->save();
            $receiver_tr->save();

            return redirect('transfers/pending/incoming');
        }

    }
}
