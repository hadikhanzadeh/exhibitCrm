@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="wbs-form-content main-content m-0 col-12">
            <header>
                <h1>{{ __('Create Booth Reserve Request') }}</h1>
                <a class="btn btn-outline-primary"
                   href="{{ route('dashboard.boothReserve') }}">{{ __('back') }}</a>
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
            <form method="post" action="{{ route('dashboard.saveBoothReserveRequest') }}">
                @csrf
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label required">{{ __('Country') }}</label>
                        <select required id="country" name="country[]" class="select2 wbsAjaxSelect2"
                                data-url="{{ route('dashboard.getCountries') }}">

                        </select>
                        <input type="hidden" id="countryTitle" name="country[]" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required">{{ __('City') }}</label>
                        <select required disabled id="city" name="city[]" class="select2 wbsAjaxSelect2"
                                data-url="{{ route('dashboard.getCites') }}">

                        </select>
                        <input type="hidden" id="cityTitle" name="city[]" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required">{{ __('Exhibition') }}</label>
                        <select required disabled id="exhibition" name="exhibition" class="select2 wbsAjaxSelect2"
                                data-url="{{ route('dashboard.getExhibitions') }}">

                        </select>
                        <input type="hidden" id="exhibitionTitle" name="exhibition-title" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required">{{ __('Activity Area') }}</label>
                        <input required type="hidden" id="genreID" name="genre[]" value="">
                        <input readonly id="genre" data-url="{{ route('dashboard.getExhibitGenre') }}" type="text"
                               name="genre[]" class="form-control"/>
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="company" class="form-label required">{{ __('Company name') }}</label>
                        <input required class="form-control" name="company" id="company"
                               value="" type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label required for="ceo-name" class="form-label required">{{ __('CEO name') }}</label>
                        <input class="form-control" name="ceo-name" id="ceo-name"
                               value=""
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="mobile_phone" class="form-label required">{{ __('Phone number') }}</label>
                        <input required dir="ltr" class="form-control" name="mobile_phone" id="mobile_phone"
                               value=""
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input class="form-control" name="email" id="email" value="" type="email">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="responsible" class="form-label required">{{ __('Name of Responsible') }}</label>
                        <input required class="form-control" name="responsible" id="responsible"
                               value=""
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required" for="meterage">{{ __('Booth meterage') }}
                            <small>({{ __('meters') }})</small></label></label>
                        <input required type="number" name="meterage" class="form-control" id="meterage"
                               value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="dimensions">{{ __('Booth dimensions') }}</label>
                        <input required type="text" name="dimensions" class="form-control" id="dimensions"
                               value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label
                            class="form-label">{{ __('Need to building a booth at the exhibition :') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input checked type="radio" name="need_building" value="1"
                                       class="form-check-input">
                                {{ __('Yes')}}
                            </label>
                            <label>
                                <input type="radio" name="need_building" value="0" class="form-check-input">
                                {{ __('No') }}
                            </label>
                        </div>
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
    <br>
    <br>
@endsection
