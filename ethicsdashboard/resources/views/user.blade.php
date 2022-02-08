@extends('layouts.app')

@section('content')

    <div class="container">
        
        <div class="card">

            <div class="card-header">
              Profile
            </div>

            <div class="card-body">
              
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" placeholder="Firstname Lastname" name="name" value="{{$user->name}}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">

                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="" id="role" checked disabled>
                                    <label class="form-check-label" for="role">
                                      {{$user->role->role}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="float-right btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

          </div>

    </div>

@endsection