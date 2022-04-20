@extends('layouts.app')

@section('content')
  <div class="container">

      <div class="row justify-content-center">
          <div class="col-10">
              <h1 class="display-5">Account Details</h1>
              <p class="lead"></p>
              @if ($account != null)
              <table class="table table-borderless mt-3 text-center">
                  <thead>
                      <tr>
                          <th class="h4">Account #</th>
                          <th class="h4">Account Type</th>
                          <th class="h4">Balance</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>{{ $account->account_no }}</td>
                          <td>{{ $account->type . ' account ' }}</td>
                          <td>{{ '$'.number_format($account->balance, 2, '.', ',') }}</td>
                      </tr>
                  </tbody>
              </table>
              @endif
              <div class="row mt-4 display-7">
                  <div class="col">
              <h2 >Transaction History</h2>
                  </div>
                  <div class="col text-end">
              <form action="/accounts/{{$account->account_no}}" method="get">
                <input type="text" name="query_email" placeholder="Search by Email"/>
                <input type="submit" value="Search">
              </form>
                  </div>
              </div>
              <table class="table-hover table table-sm text-center mt-3">
                  <thead>
                      <tr class="table-secondary">
                          <th>Transaction #</th>
                          <th>Account #</th>
                          <th>Transaction Type</th>
                          <th>Contact Email</th>
                          <th>Amount</th>
                          {{-- <th>New Balance</th> --}}
                          <th>Status</th>
                          <th>Date & Time</th>
                      </tr>
                  </thead>
                  <tbody>

                      @if (!is_null($account->transactions))
                          @if (!empty(request()->query_email))
                              @foreach ($account->transactions->where('contact_email',request()->query_email)->sortByDESC('updated_at') as $transaction)
                                  <tr>
                                      <td>{{ $transaction->transaction_no}}</td>
                                      <td>{{ $transaction->account_no }}</td>
                                      <td>{{ $transaction->type}}</td>
                                      <td>{{ $transaction->contact_email }}</td>
                                      <td>${{ $transaction->amount }}</td>
                                      {{-- <td>${{ $account->new_balance }}</td> --}}
                                      <td>{{ $transaction->status }}</td>
                                      <td>{{ $transaction->updated_at }}</td>
                                  </tr>
                              @endforeach
                          @else
                              @foreach ($account->transactions as $transaction)
                                  <tr>
                                      <td>{{ $transaction->transaction_no}}</td>
                                      <td>{{ $transaction->account_no }}</td>
                                      <td>{{ $transaction->type}}</td>
                                      <td>{{ $transaction->contact_email }}</td>
                                      <td>${{ $transaction->amount }}</td>
{{--                                       <td>${{ $account->new_balance }}</td>--}}
                                      <td>{{ $transaction->status }}</td>
                                      <td>{{ $transaction->updated_at }}</td>
                                  </tr>
                              @endforeach
                          @endif
                      @else
                          <tr>
                              <td colspan="8"><i>No transactions to display.</i></td>
                          </tr>
                      @endif
                  </tbody>
              </table>

              <div class="row justify-content-center mt-5">
                  @if (request()->query_email)
                      <a href="{{ url()->previous() }}" class="btn btn-secondary col-2 me-2">Back</a>
                  @else
                      <a href="/accounts" class="btn btn-secondary col-2 me-2">Back to Summary</a>
                  @endif
              </div>
          </div>
      </div>
</div>
@endsection
