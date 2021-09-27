@extends('layouts.app')

@section('content')
    <div class="container" x-data="{ recovery: false }">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">

                        <div class="alert alert-info" role="alert" x-show="! recovery">
                            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                        </div>

                        <div class="alert alert-info" role="alert" x-show="recovery">
                            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                        </div>

                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="form-group row" x-show="! recovery">
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                        name="code" value="{{ old('code') }}" autocomplete="one-time-code">

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" x-show="recovery">
                                <label for="recovery_code"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Recovery Code') }}</label>

                                <div class="col-md-6">
                                    <input id="recovery_code" type="text"
                                        class="form-control @error('recovery_code') is-invalid @enderror"
                                        name="recovery_code" value="{{ old('recovery_code') }}"
                                        autocomplete="one-time-code">

                                    @error('recovery_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>

                                <div class="col-md-5">
                                    <button type="button" class="btn btn-secondary" x-show="! recovery" x-on:click="
                                                                    recovery = true;
                                                                    $nextTick(() => { $refs.recovery_code.focus() })
                                                                ">
                                        {{ __('Use a recovery code') }}
                                    </button>

                                    <button type="button" class="btn btn-secondary" x-show="recovery" x-on:click="
                                                                    recovery = false;
                                                                    $nextTick(() => { $refs.code.focus() })
                                                                ">
                                        {{ __('Use an authentication code') }}
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
