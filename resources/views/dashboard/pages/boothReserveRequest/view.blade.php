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
                        <label for="manager_name" class="form-label">{{ __('CEO name') }}</label>
                        <input class="form-control" name="manager_name" id="manager_name"
                               value="{{ $item->manager_name }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="mobile" class="form-label">{{ __('Phone number') }}</label>
                        <input dir="ltr" class="form-control" name="mobile" id="mobile"
                               value="{{ $item->mobile_phone }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input class="form-control" name="email" id="email" value="{{ $item->email }}" type="email">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="user_id" class="form-label">{{ __('Name of Responsible') }}</label>
                        <input disabled class="form-control" name="user_id" id="user_id"
                               value="{{ $item->responsible }}"
                               type="text">
                    </fieldset>
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
                </div>
                <div class="row">
                    <fieldset class="col-md-3">
                        <label for="tracking_code" class="form-label">{{ __('Tracking code') }}</label>
                        <input disabled dir="ltr" class="form-control"
                               value="{{ $item->tracking_code }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="created_at" class="form-label">{{ __('Created at') }}</label>
                        <input disabled dir="ltr" class="form-control" name="created_at" id="created_at"
                               value="{{ app()->getLocale() === 'fa' ? verta($item->created_at) : $item->created_at }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="updated_at" class="form-label">{{ __('Updated at') }}</label>
                        <input disabled dir="ltr" class="form-control" name="updated_at" id="updated_at"
                               value="{{ $item->updated_at ? (app()->getLocale() === 'fa' ?  verta($item->updated_at)  : $item->updated_at) : '-' }}"
                               type="text">
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
