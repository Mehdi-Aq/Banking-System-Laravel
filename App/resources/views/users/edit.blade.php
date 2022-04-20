@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="display-5">Profile Settings</h1>
        <div class="card mt-3">
            <div class="card-header">Edit Basic Info</div>
          <div class="card-body">
            <form method="POST" action="/users/{{ $user->id }}">
              @csrf
              @method('PUT')
              <div class="row mb-3">
                <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                <div class="col-md-6">
                  <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                    name="address" value="{{ $user->address }}" required autocomplete="address" autofocus>

                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>

                <div class="col-md-6">
                  <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                    value="{{ $user->city }}" required autocomplete="city" autofocus>

                  @error('city')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="province" class="col-md-4 col-form-label text-md-end">{{ __('Province') }}</label>

                <div class="col-md-6">
                  <input id="province" type="text" class="form-control @error('province') is-invalid @enderror"
                    name="province" value="{{ $user->province }}" required autocomplete="province" autofocus>

                  @error('province')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="postalcode" class="col-md-4 col-form-label text-md-end">{{ __('Postal Code') }}</label>

                <div class="col-md-6">
                  <input id="postalcode" type="text" class="form-control @error('postalcode') is-invalid @enderror"
                    name="postalcode" value="{{ $user->postalcode }}" required autocomplete="postalcode" autofocus>

                  @error('postalcode')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                <div class="col-md-6">
                  <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    value="{{ $user->phone }}" required autocomplete="phone" autofocus>

                  @error('phone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $user->email }}" required autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
