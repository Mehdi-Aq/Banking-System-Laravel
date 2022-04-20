@extends('layouts.app')

@section('content')
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-10">
                <h1 class="display-5">Pending Transfers <small class="text-muted">Incoming</small></h1>
                <p class="lead">Accept or decline incoming transfers.</p>
                <table class="table mt-3 text-center">
                    <thead>
                    <tr>
                        <th scope="col">Transaction #</th>
                        <th scope="col">From</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Deposit In</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($transactions) >= 1)
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="align-middle">{{ $transaction->transaction_no }}</td>
                                <td class="align-middle">{{ $transaction->account->user->firstname }}
                                    {{$transaction->account->user->lastname}}</td>
                                <td class="align-middle">${{ $transaction->amount }}</td>
                                <form method="post" action="/transactions/{{$transaction->id}}">
                                    @csrf
                                    @method('put')
                                <td>
                                    <select name = "account_no" id="{{$transaction->transaction_no}}" class="form-select">
                                        @foreach (request()->user()->accounts as $account)
                                            <option data-transaction_no="{{ $transaction->transaction_no }}" value="{{ $account->account_no }}">
                                                {{ "Account #$account->account_no ($account->type)" }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button class="accept btn btn-primary btn-sm me-1" type="submit" name="action" value="accept">Accept</button>
                                    <button class="decline btn btn-danger btn-sm" type="submit" name="action" value="decline">Decline</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"><i>You have no incoming transfers.</i></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
