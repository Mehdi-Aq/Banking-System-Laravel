@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1 class="display-5">Send Money</h1>
                <p class="lead">Enter the details for your transaction.</p>
                <a href="/transfer/contact">Add Contact</a>
                <form action="/transfer/confirmation" method="post">
                    @csrf
                    <div class="my-3">
                        <Label for="account_nos" class="mb-1">From</Label>
                        <select id="account_nos" class="form-select" name="account_no">
                            @foreach ($user->accounts as $account)
                                <option data-balance="{{ $account->balance }}" value="{{ $account->account_no }}">{{ "Account #$account->account_no ($account->type) | Balance: $$account->balance " }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-3">
                        <Label for="contact_emails" class="mb-1">To</Label>
                        <select id="contact_emails" class="form-select" name="contact_email" required>

                        @foreach ($user->contacts as $contact)
                            <option value="{{ $contact->contact_email }}">{{$contact->contact_email}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="amount" class="mb-1">Amount</label>
                        <input type="number" id="amount" class="form-control mb-4" name="amount" min="1" placeholder="$0.00" step=".01" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
