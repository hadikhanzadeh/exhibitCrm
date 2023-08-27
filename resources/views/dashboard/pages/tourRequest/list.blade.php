@extends('layouts.app')

@section('content')
    @if (\Session::has('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="title">
                <h1>درخواست های تور</h1>
            </div>
        </div>
    </div>

    @include('dashboard.parts.filter')

    <div class="row">
        <div class="col-12">
            <div class="main-content">
                <header>
                    <h2>نتایج</h2>
                    <div class="left-side">
                        <input type="text" id="searchInTable" class="form-control" placeholder="جستجو در نتایج..."/>
                    </div>
                </header>
                <div class="content">
                    <table
                        class="table wbs-profile-table table-borderless table-head-bg">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تاریخ</th>
                            <th>عنوان نمایشگاه</th>
                            <th>کشور</th>
                            <th>شهر</th>
                            <th>نام شرکت</th>
                            <th>نام مسئول</th>
                            <th>شرکت کنندگان</th>
                            <th>شماره تماس</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
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
                                    <td>{!! $item->exhibition_title !!}</td>
                                    <td>{!! $item->country_title !!}</td>
                                    <td>{!! $item->city_title !!}</td>
                                    <td>{!! $item->company_name !!}</td>
                                    <td>{!! $item->manager !!}</td>
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
                                    موردی یافت نشد!
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
