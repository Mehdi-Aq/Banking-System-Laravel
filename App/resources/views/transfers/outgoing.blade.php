<?php use Carbon\Carbon; ?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <h1 class="display-5">Pending Transfers <small class="text-muted">Outgoing</small></h1>
                <p class="lead">Cancel outgoing transfers.</p>
                <table class="table mt-3 text-center">
                    <thead>
                    <tr>
                        <th scope="col">Transaction #</th>
                        <th scope="col">To</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($transactions) >= 1)
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="align-middle">{{ $transaction->transaction_no }}</td>
                                <td class="align-middle">{{ $transaction->contact_email }}</td>
                                <td class="align-middle">${{ $transaction->amount }}</td>
                                <td>
                                    <form method="post" action="/transactions/{{$transaction->id}}">
                                        @csrf
                                        @method('put')
                                    <button class="cancel btn btn-danger btn-sm" name="action"
                                            @if ( Carbon::now()->diffInSeconds($transaction->created_at) > 2 * 60 * 60)
                                                disabled
                                            @endif
                                            value="cancel">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"><i>You have no outgoing transfers.</i></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
