@extends('layouts.app')

@section('content')
    @include('dashboard.parts.messages')
    <div class="row">
        <div class="col-12">
            <div class="title">
                <h1>{{ __('Booth Reserve Requests') }}</h1>
            </div>
        </div>
    </div>

    @include('dashboard.parts.filter',['excludeFields' => []])

    <div class="row">
        <div class="col-12">
            <div class="main-content">
                <header>
                    <h2>{{ __('Results') }}</h2>
                    <div class="left-side">
                        <input type="text" id="searchInTable" class="form-control"
                               placeholder="{{ __('Search in results...') }}"/>
                    </div>
                </header>
                <div class="content">
                    <table
                        class="table wbs-profile-table table-borderless table-head-bg">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('The title of the exhibition')}}</th>
                            <th>{{ __('Country') }}</th>
                            <th>{{ __('City') }}</th>
                            <th> {{ __('Total requests') }}</th>
                            <th>{{ __('Total Meterage') }}</th>
                            <th>{{ __('Operation') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$items->isEmpty())
                            @php
                                $i = 1;
                            @endphp
                            @foreach($items as  $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{!! $item->exhibition_title !!}</td>
                                    <td>{!! $item->country_title !!}</td>
                                    <td>{!! $item->city_title !!}</td>
                                    <td>{{ $item->totalCount }}</td>
                                    <td>{{ $item->totalSize . ' ' . __('meter') }}</td>
                                    <td class="action">
                                        <a href="{{ route('dashboard.reserveGroupIndex',$item->exhibition_id) }}"><i
                                                class="icon-eye-2"></i></a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach()
                        @else
                            <tr>
                                <td colspan="10" class="text-center">
                                    {{ __('Nothing found!') }}
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
