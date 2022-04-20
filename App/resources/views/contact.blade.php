@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1 class="display-5">Add Contact</h1>
                <p class="lead">Enter your contact's information.</p>
                <form action="/transfer/contact" method="post">
                    @csrf
                    <div class="mt-3 mb-4">
                        <Label for="email" class="mb-1">Email</Label>
                        <input type="email" class="form-control mb-3" name="email" placeholder="Email address" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Add Contact</button>
                    <a href="/transfer" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
