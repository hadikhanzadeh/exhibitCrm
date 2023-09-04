@extends('layouts.app')

@section('content')
    @include('dashboard.parts.messages')

    <div class="row">
        <div class="col-12">
            <header class="title">
                <h1> {{ __('Tour requests for ') . $items[0]->exhibition_title }}</h1>
                <a class="btn btn-outline-primary" href="{{ route('dashboard.tourRequest') }}">{{ __('back') }}</a>
            </header>
        </div>
    </div>

    @include('dashboard.parts.filter',['excludeFields' => ['exhibition_title']])

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
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Country') }}</th>
                            <th>{{ __('City') }}</th>
                            <th>{{ __('Company Name') }}</th>
                            <th>{{ __('Name of Responsible') }}</th>
                            <th>{{ __('Participants') }}</th>
                            <th>{{ __('Phone number') }}</th>
                            <th>{{ __('Status') }}</th>
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
                                    <td dir="ltr">{!! verta($item->created_at) !!}</td>
                                    <td>{!! $item->country_title !!}</td>
                                    <td>{!! $item->city_title !!}</td>
                                    <td>{!! $item->company_name !!}</td>
                                    <td>{!! $item->responsible !!}</td>
                                    <td>{{ $item->participants }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{!!  \App\Http\Lib\wbsUtility::getStatus($item->status) !!}</td>
                                    <td class="action">
                                        <a href="{{ route('dashboard.viewTourRequest',$item->id) }}"><i
                                                class="icon-eye-2"></i></a>
                                        <a class="delete-item"
                                           href="{{ route('dashboard.destroyTourRequest',$item->id)  }}"><i
                                                class="icon-cancel-2"></i></a>
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
                    @if ($items->links()->paginator->hasPages())
                        <div class="wbs-paginate">
                            {{ $items->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
