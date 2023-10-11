@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="wbs-form-content main-content m-0 col-12">
            <header>
                <h1>{{ __('Create New User') }}</h1>
                <a class="btn btn-outline-primary"
                   href="{{ route('dashboard.users') }}">{{ __('back') }}</a>
            </header>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            @endif

            <form method="post" action="{{ route('dashboard.saveUser') }}">
                @csrf
                <div class="row mb-3">
                    <fieldset class="col-md-4">
                        <label class="form-label required">{{ __('Full Name') }}</label>
                        <input class="form-control" type="text" required id="fullName" name="fullName"
                               value="{{ old('fullName') }}">
                    </fieldset>
                    <fieldset class="col-md-4">
                        <label class="form-label required">{{ __('Email') }}</label>
                        <input class="form-control" type="text" required id="email" name="email"
                               value="{{ old('email') }}">
                    </fieldset>
                    <fieldset class="col-md-4">
                        <label class="form-label required">{{ __('Role') }}</label>
                        <select class="form-select" name="role">
                            <option value="admin">مدیرکل</option>
                            <option selected value="operator">اپراتور</option>
                        </select>
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-4">
                        <label class="form-label required">{{ __('Password') }}</label>
                        <input class="form-control" type="password" required id="password" name="password">
                    </fieldset>
                    <fieldset class="col-md-4">
                        <label class="form-label required">{{ __('Confirm Password') }}</label>
                        <input class="form-control" type="password" required id="confirm-password"
                               name="confirm-password">
                    </fieldset>
                </div>
                <div class="row mt-5 justify-content-between">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">{{ __('Create User') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
