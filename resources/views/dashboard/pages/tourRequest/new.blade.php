@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="wbs-form-content main-content m-0 col-12">
            <header>
                <h1>{{ __('Create tour request') }}</h1>
                <a class="btn btn-outline-primary"
                   href="{{ route('dashboard.tourRequest') }}">{{ __('back') }}</a>
            </header>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @php
                    Session::remove('success');
                @endphp
            @elseif(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
                @php
                    Session::remove('error');
                @endphp
            @endif
            <form method="post" action="{{ route('dashboard.saveTourRequest') }}">
                @csrf
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Country') }}</label>
                        <select id="country" name="country[]" class="select2 wbsAjaxSelect2"
                                data-url="{{ route('dashboard.getCountries') }}">

                        </select>
                        <input type="hidden" id="countryTitle" name="country[]" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('City') }}</label>
                        <select disabled id="city" name="city[]" class="select2 wbsAjaxSelect2"
                                data-url="{{ route('dashboard.getCites') }}">

                        </select>
                        <input type="hidden" id="cityTitle" name="city[]" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Exhibition') }}</label>
                        <select disabled id="exhibition" name="exhibition" class="select2 wbsAjaxSelect2"
                                data-url="{{ route('dashboard.getExhibitions') }}">

                        </select>
                        <input type="hidden" id="exhibitionTitle" name="exhibition-title" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Activity Area') }}</label>
                        <input type="hidden" id="genreID" name="genre[]" value="">
                        <input readonly id="genre" data-url="{{ route('dashboard.getExhibitGenre') }}" type="text"
                               name="genre[]" class="form-control"/>
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="company" class="form-label">{{ __('Company name') }}</label>
                        <input class="form-control" name="company" id="company"
                               value="" type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="ceo-name" class="form-label">{{ __('CEO name') }}</label>
                        <input class="form-control" name="ceo-name" id="ceo-name" value=""
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="phone" class="form-label">{{ __('Phone number') }}</label>
                        <input dir="ltr" class="form-control" name="phone" id="phone" value=""
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input class="form-control" name="email" id="email" value="" type="email">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="responsible" class="form-label">{{ __('Name of Responsible') }}</label>
                        <input class="form-control" name="responsible" id="responsible"
                               value=""
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="participants" class="form-label">{{ __('Participants') }}</label>
                        <input class="form-control" name="participants" id="participants"
                               value="" type="number">
                    </fieldset>
                </div>

                <div class="row mt-5 justify-content-between">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">{{ __('Create Request') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
