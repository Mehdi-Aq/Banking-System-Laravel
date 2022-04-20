@extends('layouts.app')

@section('content')
        <div class="row justify-content-center my-4">
            <div class="col-4 border border-1 rounded px-4 py-4">
                <h1 class="text-success display-5">Money Sent!</h1>
                <p>The recipient has two hours to accept the payment.</p>
                <hr>
                <div class="mt-3 mb-4">
                    <h5>Confirmation #</h5>
                    <p>{{ $transaction->transaction_no }}</p>
                </div>
                <div class="mt-3 mb-4">
                    <h5>From Account</h5>
                    <p>{{ $transaction->account_no }}</p>
                </div>
                <div class="mt-3 mb-4">
                    <h5>Amount</h5>
                    <p>${{ $transaction->amount }}</p>
                </div>
                <div class="mt-3 mb-4">
                    <h5>Recipient Email</h5>
                    <p>{{ $transaction->contact_email }}</p>
                </div>
                <a href="/transfer" class="btn btn-primary me-2">Send Another Payment</a>
                <a href="/transfers/pending/outgoing" class="btn btn-secondary">View Outgoing Transfers</a>
            </div>
        </div>
    </div>
@endsection
