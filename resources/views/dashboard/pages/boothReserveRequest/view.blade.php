@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="wbs-form-content main-content m-0 col-12">
            <header>
                <h1>{{ __('View booth building request') }}</h1>
                <a class="btn btn-outline-primary"
                   href="{{ route('dashboard.reserveGroupIndex',['exhibit_id' => $item->exhibition_id]) }}">{{ __('back') }}</a>
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
            <form method="post" action="{{ route('dashboard.updateBoothReserve', $item->id) }}">
                @csrf
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Country') }}</label>
                        <p>{!! $item->country_title !!}</p>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('City') }}</label>
                        <p>{!! $item->city_title !!}</p>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Activity Area') }}</label>
                        <p>{!! $item->activity_area_title !!}</p>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Exhibition') }}</label>
                        <p>{!! $item->exhibition_title !!}</p>
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="company_name" class="form-label">{{ __('Company name') }}</label>
                        <input class="form-control" name="company_name" id="company_name"
                               value="{{ $item->company_name }}" type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="manager" class="form-label">{{ __('CEO name') }}</label>
                        <input class="form-control" name="manager" id="manager" value="{{ $item->manager_name }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="user_id" class="form-label">{{ __('Name of Responsible') }}</label>
                        <input disabled class="form-control" name="user_id" id="user_id"
                               value="{{ $item->responsible }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="mobile" class="form-label">{{ __('Phone number') }}</label>
                        <input dir="ltr" class="form-control" name="mobile" id="mobile"
                               value="{{ $item->mobile_phone }}"
                               type="text">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label" for="size">{{ __('Booth meterage') }}
                            <small>({{ __('meters') }})</small></label></label>
                        <input type="number" name="size" class="form-control" id="size"
                               value="{{ $item->meterage_booth }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="dimensions">{{ __('Booth dimensions') }}</label>
                        <input type="text" name="dimensions" class="form-control" id="dimensions"
                               value="{{ $item->dimensions_booth }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="hall-name">{{ __('Hall name') }}</label>
                        <input type="text" name="hall-name" class="form-control" id="hall-name"
                               value="{{ $item->hall_name }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="corporate-color">{{ __('Corporate color') }}</label>
                        <input type="text" name="corporate-color" class="form-control" id="corporate-color"
                               value="{{ $item->corporate_color }}">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="showcase-product">{{ __('Display type of showcase products') }}</label>
                        <input type="text" name="showcase-product" class="form-control"
                               id="showcase-product" value="{{ $item->showcase_product }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="equipment">{{ __('equipment') }}</label>
                        <input type="text" name="equipment" class="form-control"
                               id="equipment" value="{{ $item->equipment }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="product-count">{{ __('Number of products') }}</label>
                        <input type="number" name="product-count" class="form-control"
                               id="product-count" value="{{ $item->product_count }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="product-type">{{ __('Type of products') }}</label>
                        <input type="text" name="product-type" class="form-control"
                               id="product-type" value="{{ $item->product_type }}">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="product-dimensions">{{ __('Product dimensions') }}</label>
                        <input type="text" name="product-dimensions" class="form-control"
                               id="product-dimensions" value="{{ $item->product_dimensions }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="answering-desks">{{ __('Number of answering desks') }}</label>
                        <input type="number" name="answering-desks" class="form-control"
                               id="answering-desks" value="{{ $item->answering_desks }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label"
                               for="budget">{{ __('The amount of the budget') }}
                            <small>({{ __('Rial') }})</small></label>
                        <input type="text" name="budget" class="form-control"
                               id="budget" value="{{ number_format($item->amount_budget) }}">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input class="form-control" name="email" id="email" value="{{ $item->email }}" type="email">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="website" class="form-label">{{ __('Website') }}</label>
                        <input class="form-control" name="website" id="website" value="{{ $item->website }}"
                               type="text" dir="ltr">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="tracking_code" class="form-label">{{ __('Tracking code') }}</label>
                        <input disabled dir="ltr" class="form-control"
                               value="{{ $item->tracking_code }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="status" class="form-label">{{ __('Status') }}</label>
                        <select name="status" id="status" class="form-select">
                            <option value="0">{{ __('Select...') }}</option>
                            <option
                                {{ $item->status === 'pending' ? 'selected': '' }} value="pending">
                                {{ __('Pending') }}
                            </option>
                            <option {{ $item->status === 'awaiting' ? 'selected': '' }} value="awaiting">
                                {{ __('Awaiting') }}
                            </option>
                            <option {{ $item->status === 'pending' ? 'complete': '' }} value="complete">
                                {{ __('Completed') }}
                            </option>
                        </select>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="created_at" class="form-label">{{ __('Created at') }}</label>
                        <input disabled dir="ltr" class="form-control" name="created_at" id="created_at"
                               value="{{ app()->getLocale() === 'fa' ? verta($item->created_at) : $item->created_at }}"
                               type="text">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="updated_at" class="form-label">{{ __('Updated at') }}</label>
                        <input disabled dir="ltr" class="form-control" name="updated_at" id="updated_at"
                               value="{{ $item->updated_at ? (app()->getLocale() === 'fa' ?  verta($item->updated_at)  : $item->updated_at) : '-' }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Design type') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input {{ $item->design_type === 'crow' ? 'checked' : '' }} type="radio"
                                       name="design-type"
                                       value="crow"
                                       class="form-check-input">
                                {{ __('Crow') }}
                            </label>
                            <label>
                                <input {{ $item->design_type === 'minimal' ? 'checked' : '' }} type="radio"
                                       name="design-type" value="minimal"
                                       class="form-check-input">
                                {{ __('Minimal') }}
                            </label>
                            <label>
                                <input {{ $item->design_type === 'bar-table' ? 'checked' : '' }} type="radio"
                                       name="design-type" value="bar-table"
                                       class="form-check-input">
                                {{ __('Bar table') }}
                            </label>
                            <label>
                                <input {{ $item->design_type === 'special-guests' ? 'checked' : '' }} type="radio"
                                       name="design-type" value="special-guests"
                                       class="form-check-input">
                                {{ __('A place for special guests') }}
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Booth height') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input {{ $item->height_booth === '3' ? 'checked' : '' }}
                                       type="radio" name="height" value="3"
                                       class="form-check-input">
                                3 {{ __('meters') }}
                            </label>
                            <label>
                                <input {{ $item->height_booth === '3.55' ? 'checked' : '' }} type="radio" name="height"
                                       value="3.55"
                                       class="form-check-input">
                                3.55 {{ __('meters') }}
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">{{ __('Need for flower arrangement') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input {{ $item->flower_arrangement === '1' ? 'checked' : '' }} type="radio"
                                       name="flower-arrangement" value="1"
                                       class="form-check-input">
                                {{ __('Yes') }}
                            </label>
                            <label>
                                <input {{ $item->flower_arrangement === '0' ? 'checked' : '' }} type="radio"
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
                            class="form-label">{{ __('Exhibition services in another city') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input {{ $item->another_city === '1' ? 'checked' : '' }} type="radio"
                                       name="another-city" value="1"
                                       class="form-check-input">
                                {{ __('Yes') }}
                            </label>
                            <label>
                                <input {{ $item->another_city === '0' ? 'checked' : '' }} type="radio"
                                       name="another-city" value="0" class="form-check-input">
                                {{ __('No') }}
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label
                            class="form-label">{{ __('Booth construction services outside Iran') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input {{ $item->another_country === '1' ? 'checked' : '' }} type="radio"
                                       name="another-country" value="1"
                                       class="form-check-input">
                                {{ __('Yes') }}
                            </label>
                            <label>
                                <input {{ $item->another_country === '0' ? 'checked' : '' }} type="radio"
                                       name="another-country" value="0" class="form-check-input">
                                {{ __('No') }}
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label
                            class="form-label">{{ __('Need to reserve a booth at the exhibition') }}</label>
                        <div class="radio-panel">
                            <label>
                                <input {{ $item->need_reserve === '1' ? 'checked' : '' }} type="radio"
                                       name="need-reserve" value="1"
                                       class="form-check-input">
                                {{ __('Yes') }}
                            </label>
                            <label>
                                <input {{ $item->need_reserve === '0' ? 'checked' : '' }} type="radio"
                                       name="need-reserve" value="0" class="form-check-input">
                                {{ __('No') }}
                            </label>
                        </div>
                    </fieldset>
                </div>
                <div class="row mt-5 justify-content-between">
                    <div class="col-2">
                        <a href="{{ route('dashboard.destroyBoothReserve', $item->id) }}"
                           class="btn btn-danger delete-item">{{ __('Delete') }}</a>
                    </div>
                    <div class="col-2 text-end">
                        <input type="hidden" value="{{$item->id}}" name="id">
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <br>
@endsection
