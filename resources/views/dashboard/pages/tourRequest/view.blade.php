@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="wbs-form-content main-content m-0 col-12">
            <header>
                <h1>مشاهده درخواست تور</h1>
                <a class="btn btn-outline-primary" href="{{ route('dashboard.tourRequest') }}">{{ __('back') }}</a>
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
            <form method="post" action="{{ route('dashboard.updateTourRequest', $item->id) }}">
                @csrf
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label">کشور</label>
                        <p>{!! $item->country_title !!}</p>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">شهر</label>
                        <p>{!! $item->city_title !!}</p>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">حوزه</label>
                        <p>{!! $item->activity_area_title !!}</p>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">نمایشگاه</label>
                        <p>{!! $item->exhibition_title !!}</p>
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="company_name" class="form-label">نام شرکت</label>
                        <input class="form-control" name="company_name" id="company_name"
                               value="{{ $item->company_name }}" type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="manager" class="form-label">نام مدیرعامل</label>
                        <input class="form-control" name="manager" id="manager" value="{{ $item->manager }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="mobile" class="form-label">شماره تماس</label>
                        <input dir="ltr" class="form-control" name="mobile" id="mobile" value="{{ $item->mobile }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="email" class="form-label">آدرس ایمیل</label>
                        <input class="form-control" name="email" id="email" value="{{ $item->email }}" type="email">
                    </fieldset>
                </div>
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label for="user_id" class="form-label">مسئول ثبت</label>
                        <input disabled class="form-control" name="user_id" id="user_id"
                               value="{{ $item->user_id }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="participants" class="form-label">تعداد شرکت کنندگان</label>
                        <input class="form-control" name="participants" id="participants"
                               value="{{ $item->participants }}" type="number">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="tracking_code" class="form-label">کد پیگیری</label>
                        <input disabled dir="ltr" class="form-control"
                               value="{{ $item->tracking_code }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="status" class="form-label">وضعیت</label>
                        <select name="status" id="status" class="form-select">
                            <option value="0">انتخاب کنید...</option>
                            <option {{ $item->status === 'pending' ? 'selected': '' }} value="pending">در انتظار
                                بررسی
                            </option>
                            <option {{ $item->status === 'awaiting' ? 'selected': '' }} value="awaiting">در حال
                                رسیدگی
                            </option>
                            <option {{ $item->status === 'pending' ? 'complete': '' }} value="complete">تکمیل شده
                            </option>
                        </select>
                    </fieldset>
                </div>
                <div class="row">
                    <fieldset class="col-md-3">
                        <label for="created_at" class="form-label">تاریخ ایجاد</label>
                        <input disabled dir="ltr" class="form-control" name="created_at" id="created_at"
                               value="{{ verta($item->created_at) }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="updated_at" class="form-label">آخرین به روز رسانی</label>
                        <input disabled dir="ltr" class="form-control" name="updated_at" id="updated_at"
                               value="{{ $item->updated_at ? verta($item->updated_at) : '-' }}"
                               type="text">
                    </fieldset>
                </div>

                <div class="row mt-5 justify-content-between">
                    <div class="col-2">
                        <a href="{{ route('dashboard.destroyTourRequest', $item->id) }}"
                           class="btn btn-danger delete-item">حذف</a>
                    </div>
                    <div class="col-2 text-end">
                        <input type="hidden" value="{{$item->id}}" name="id">
                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
