@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="title">
                <h1>درخواست های تور</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="wbs-panel">
                <header>
                    <h2>فیلتر نتایج</h2>
                    <span><i class="icon-down-open-1"></i></span>
                </header>
                <div class="content">
                    <form id="v" action="">
                        @csrf
                        <fieldset>
                            <label class="form-label">کشور</label>
                            <select data-url="{{ route('dashboard.getCountries') }}" id="country"
                                    class="wbsAjaxSelect2"
                                    name="country">
                            </select>
                        </fieldset>
                        <fieldset>
                            <label class="form-label">شهر</label>
                            <select multiple disabled data-url="{{ route('dashboard.getCites') }}" id="city"
                                    class="wbsAjaxSelect2"
                                    name="city">
                            </select>
                        </fieldset>
                        <fieldset>
                            <label class="form-label">حوزه</label>
                            <select multiple data-url="{{ route('dashboard.getGenre') }}" id="genre"
                                    class="wbsAjaxSelect2"
                                    name="genre">
                            </select>
                        </fieldset>
                        <fieldset>
                            <label class="form-label">تاریخ درخواست</label>
                            <input type="text" name="register_date" class="form-control"/>
                        </fieldset>
                        <fieldset>
                            <label class="form-label">وضعیت</label>
                            <select name="status" class="form-select">
                                <option value="0">انتخاب کنید...</option>
                                <option value="pending">در انتظار بررسی</option>
                                <option value="awaiting">در حال رسیدگی</option>
                                <option value="complete">تکمیل شده</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
