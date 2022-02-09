@extends('layouts.app')

@section('content')

    <div class="container">
        
        <div class="card">

            <div class="card-header">
              Profile
            </div>

            <div class="card-body">
              
                <div class="card-body">
                    <form id="profileform" method="POST" action="{{ route('user.update', $user->id) }}">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" placeholder="Firstname Lastname" name="name" value="{{$user->name}}" form="profileform" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" form="profileform" required>
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <input type="submit" class="float-right btn btn-primary" value="Update" form="profileform">
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <div class="card mt-3">

            <div class="card-header">
              Change Password
            </div>

            <div class="card-body">
              
                <div class="card-body">
                    <form id="passwordform" method="POST" action="{{ route('user.password', $user->id) }}">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}

                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control" name="old_password" form="passwordform" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new_password" form="passwordform" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new_password_confirmation" form="passwordform" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="float-right btn btn-primary" value="Change" form="passwordform">
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

@endsection