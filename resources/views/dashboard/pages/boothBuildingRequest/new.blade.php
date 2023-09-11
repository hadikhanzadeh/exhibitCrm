@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="wbs-form-content main-content m-0 col-12">
            <header>
                <h1>{{ __('Create Booth Building Request') }}</h1>
                <a class="btn btn-outline-primary"
                   href="{{ route('dashboard.boothBuilding') }}">{{ __('back') }}</a>
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
            <form method="post" action="{{ route('dashboard.saveBoothBuildingRequest') }}">
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
                        <label for="ceo-name" class="form-label required">{{ __('CEO name') }}</label>
                        <input required class="form-control" name="ceo-name" id="ceo-name" value=""
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="responsible" class="form-label required">{{ __('Name of Responsible') }}</label>
                        <input required class="form-control" name="responsible" id="responsible"
                               value=""
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="phone" class="form-label required">{{ __('Phone number') }}</label>
                        <input dir="ltr" class="form-control" name="phone" id="phone"
                               value=""
                               type="text">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label required" for="size">{{ __('Booth meterage') }}
                            <small>({{ __('meters') }})</small></label></label>
                        <input type="number" name="size" class="form-control" id="size"
                               value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="dimensions">{{ __('Booth dimensions') }}</label>
                        <input type="text" name="dimensions" class="form-control" id="dimensions"
                               value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="hall-name">{{ __('Hall name') }}</label>
                        <input type="text" name="hall-name" class="form-control" id="hall-name"
                               value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="corporate-color">{{ __('Corporate color') }}</label>
                        <input type="text" name="corporate-color" class="form-control" id="corporate-color"
                               value="">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="showcase-product">{{ __('Display type of showcase products') }}</label>
                        <input type="text" name="showcase-product" class="form-control"
                               id="showcase-product" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="equipment">{{ __('equipment') }}</label>
                        <input type="text" name="equipment" class="form-control"
                               id="equipment" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="products-number">{{ __('Number of products') }}</label>
                        <input type="number" name="products-number" class="form-control"
                               id="products-number" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="products-type">{{ __('Type of products') }}</label>
                        <input type="text" name="products-type" class="form-control"
                               id="products-type" value="">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="products-dimensions">{{ __('Product dimensions') }}</label>
                        <input type="text" name="products-dimensions" class="form-control"
                               id="products-dimensions" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="answering-desks">{{ __('Number of answering desks') }}</label>
                        <input type="number" name="answering-desks" class="form-control"
                               id="answering-desks" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required"
                               for="budget">{{ __('The amount of the budget') }}
                            <small>({{ __('Rial') }})</small></label>
                        <input type="text" name="budget" class="form-control"
                               id="budget" value="">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input class="form-control" name="email" id="email" value="" type="email">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="website" class="form-label">{{ __('Website') }}</label>
                        <input class="form-control" name="website" id="website" value=""
                               type="text" dir="ltr">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required">{{ __('Design type') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input checked type="radio"
                                       name="design-type"
                                       value="crow"
                                       class="form-check-input">
                                {{ __('Crow') }}
                            </label>
                            <label>
                                <input type="radio"
                                       name="design-type" value="minimal"
                                       class="form-check-input">
                                {{ __('Minimal') }}
                            </label>
                            <label>
                                <input type="radio"
                                       name="design-type" value="bar-table"
                                       class="form-check-input">
                                {{ __('Bar table') }}
                            </label>
                            <label>
                                <input type="radio"
                                       name="design-type" value="special-guests"
                                       class="form-check-input">
                                {{ __('A place for special guests') }}
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required">{{ __('Booth height') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input checked
                                       type="radio" name="height" value="3"
                                       class="form-check-input">
                                3 {{ __('meters') }}
                            </label>
                            <label>
                                <input type="radio" name="height"
                                       value="3.55"
                                       class="form-check-input">
                                3.55 {{ __('meters') }}
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label required">{{ __('Need for flower arrangement') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input checked type="radio"
                                       name="flower-arrangement" value="1"
                                       class="form-check-input">
                                {{ __('Yes') }}
                            </label>
                            <label>
                                <input type="radio"
                                       name="flower-arrangement" value="0"
                                       class="form-check-input">
                                {{ __('No') }}
                            </label>
                        </div>
                    </fieldset>
                </div>

                <div class="row">
                    <fieldset class="col-md-3">
                        <label
                            class="form-label required">{{ __('Exhibition services in another city') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input checked type="radio"
                                       name="another-city" value="1"
                                       class="form-check-input">
                                {{ __('Yes') }}
                            </label>
                            <label>
                                <input type="radio"
                                       name="another-city" value="0" class="form-check-input">
                                {{ __('No') }}
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label
                            class="form-label required">{{ __('Booth construction services outside Iran') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input checked type="radio"
                                       name="outside-iran" value="1"
                                       class="form-check-input">
                                {{ __('Yes') }}
                            </label>
                            <label>
                                <input type="radio"
                                       name="outside-iran" value="0" class="form-check-input">
                                {{ __('No') }}
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label
                            class="form-label required">{{ __('Need to reserve a booth at the exhibition') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input checked type="radio"
                                       name="need-reserve" value="1"
                                       class="form-check-input">
                                {{ __('Yes') }}
                            </label>
                            <label>
                                <input type="radio"
                                       name="need-reserve" value="0" class="form-check-input">
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
