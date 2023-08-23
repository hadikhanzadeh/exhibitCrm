@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="wbs-form-content main-content m-0 col-12">
            <header>
                <h1>مشاهده درخواست تور</h1>
            </header>
            <form method="post" action="">
                <div class="row mb-3">
                    <fieldset class="col-md-3">
                        <label class="form-label">کشور</label>
                        <select data-url="{{ route('dashboard.getCountries') }}" id="country"
                                class="wbsAjaxSelect2"
                                name="country">
                            <option selected
                                    value="{{ $item->country }}">{{ $item->country_title }}</option>
                        </select>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">شهر</label>
                        <select
                            data-url="{{ route('dashboard.getCites') }}"
                            id="city"
                            class="wbsAjaxSelect2"
                            name="city">
                            <option selected
                                    value="{{ $item->city }}">{{ $item->city_title }}</option>
                        </select>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">حوزه</label>
                        <select data-url="{{ route('dashboard.getGenre') }}" id="genre"
                                class="wbsAjaxSelect2"
                                name="genre">
                            <option selected
                                    value="{{ $item->activity_area }}">{{ $item->activity_area_title }}</option>
                        </select>
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label class="form-label">نمایشگاه</label>
                        <select disabled name="exhibition" class="form-select">
                            <option selected
                                    value="{{ $item->exhibition }}">{{ $item->exhibition_title }}</option>
                        </select>
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
                        <input class="form-control" name="mobile" id="mobile" value="{{ $item->mobile }}"
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
                        <input class="form-control" name="user_id" id="user_id"
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
                        <input dir="ltr" class="form-control" name="tracking_code" id="tracking_code"
                               value="{{ $item->tracking_code }}"
                               type="text">
                    </fieldset>
                    <fieldset class="col-md-3">
                        <label for="status" class="form-label">وضعیت</label>
                        <select name="status" id="status" class="form-select">
                            <option value="0">انتخاب کنید...</option>
                            <option {{ request('status') === 'pending' ? 'selected': '' }} value="pending">در انتظار
                                بررسی
                            </option>
                            <option {{ request('status') === 'awaiting' ? 'selected': '' }} value="awaiting">در حال
                                رسیدگی
                            </option>
                            <option {{ request('status') === 'pending' ? 'complete': '' }} value="complete">تکمیل شده
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
                        <button type="button" class="btn btn-danger">حذف</button>
                    </div>
                    <div class="col-2 text-end">
                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
