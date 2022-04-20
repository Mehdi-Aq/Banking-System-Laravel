<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class TransactionObserver
{

    /**
     * Handle the Transaction "creating" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function creating(Transaction $transaction)
    {
        
        $log = new Logger('logs');
        $log->pushHandler(new StreamHandler('C:\xampp\htdocs\BankingPHP\app\Logs\logs.json', Logger::WARNING));
        $log->alert("");
        $log->alert("\n\nBEFORE INSERT: ".$transaction);
        

        if ($transaction->type == "Transfer") {
            $sender_account = Account::all()->firstWhere('account_no', $transaction->account_no);
            $log->alert("Transaction Account BEFORE balance UPDATE: ".$sender_account);
            $transaction->status = "Pending";
            $new_balance = $sender_account->balance - $transaction->amount;
            if ($new_balance < 0) { return false;}
            //$sender_account->balance = $new_balance;
            //$sender_account->save();
            Account::where('account_no', $transaction->account_no)->update(['balance' => $new_balance]);
            $log->alert("Transaction Account AFTER balance UPDATE: ".Account::firstWhere('account_no', $transaction->account_no));
        }


    }

    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        if ($transaction->type == "Transfer") {
               /*
            $log = new Logger('logs');
            $log->pushHandler(new StreamHandler('C:\xampp\htdocs\BankingPHP\app\Logs\logs.json', Logger::WARNING));
            $log->alert("AFTER INSERT: ".$transaction);
            */
            $receiver = User::all()->firstWhere('email', $transaction->contact_email);
            $receiver_account_no = $receiver->accounts->random()->account_no;
            $receiver_tr = Transaction::create([
                'transaction_no' => $transaction->transaction_no,
                'amount' => $transaction->amount,
                'type' => "Deposit",
                'account_no' => $receiver_account_no,
                'status' => "Pending",
                'contact_email' => $transaction->account->user->email,
            ]);
        }
    }

    /**
     * Handle the Transaction "updating" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updating(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "updating" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
