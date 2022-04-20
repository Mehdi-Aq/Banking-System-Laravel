@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row justify-content-center">
      <div class="col-10">
          <h1 class="display-5">Accounts Summary</h1>
          <p class="lead">Brief overview of all the accounts.</p>
          <table class="table table-hover mt-3 text-center">
              <thead>
                  <tr>
                      <th scope="col">Account #</th>
                      <th scope="col">Account Type</th>
                      <th scope="col">Balance</th>
                      <th scope="col">Details</th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($user->accounts as $key => $value)
                  <tr>
                      <td class="align-middle">{{ $value->account_no }}</td>
                      <td class="align-middle">{{ $value->type . ' account ' }}</td>
                      <td class="align-middle">{{ '$'.number_format($value->balance, 2, '.', ',') }}</td>
                      <td class="align-middle"><a href="/accounts/{{ $value->account_no }}" class="btn btn-info btn-sm">View Account</a>
                      <td>
                  </tr>
              @endforeach
              </tbody>
          </table>
      </div>
  </div>
@endsection
