@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="wbs-form-content main-content m-0 col-12">
            <header>
                <h1>{{ __('View User') . ' "' .  $user->name . '"'}}</h1>
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

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @php
                    Session::remove('success');
                @endphp
            @endif

            <form method="post" action="{{ route('dashboard.updateUser') }}">
                @csrf
                <div class="row mb-3">
                    <fieldset class="col-md-4">
                        <label class="form-label required">{{ __('Full Name') }}</label>
                        <input class="form-control" type="text" required id="fullName" name="fullName"
                               value="{{ $user->name }}">
                    </fieldset>
                    <fieldset class="col-md-4">
                        <label class="form-label required">{{ __('Email') }}</label>
                        <input class="form-control" type="text" required id="email" name="email"
                               value="{{ $user->email }}">
                    </fieldset>
                    <fieldset class="col-md-4">
                        <label class="form-label required">{{ __('Role') }}</label>
                        <select class="form-select" name="role">
                            <option {{ $user->role === 'administrator' ? 'selected' : '' }} value="administrator">
                                مدیرکل
                            </option>
                            <option {{ $user->role === 'operator' ? 'selected' : '' }} value="operator">اپراتور
                            </option>
                        </select>
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-4">
                        <label class="form-label">{{ __('Password') }}</label>
                        <input class="form-control" type="password" id="password" name="password">
                    </fieldset>
                    <fieldset class="col-md-4">
                        <label class="form-label">{{ __('Confirm Password') }}</label>
                        <input class="form-control" type="password" id="confirm-password"
                               name="password_confirmation">
                    </fieldset>
                </div>
                <div class="row mt-5 justify-content-between">
                    @if(Auth::id() !== $user->id)
                        <div class="col-6">
                            <a href="{{ route('dashboard.destroyUser', $user->id) }}"
                               class="btn btn-danger delete-item">{{ __('Delete') }}</a>
                        </div>
                        <div class="col-6 text-end">
                            @else
                                <div class="col-12 text-end">
                                    @endif
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-primary">{{ __('Update User') }}</button>
                                </div>
                        </div>
            </form>
        </div>
    </div>

@endsection
