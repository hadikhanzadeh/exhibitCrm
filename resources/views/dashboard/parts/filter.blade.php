<div class="row">
    <div class="col-12">
        <div class="wbs-panel">
            <header class="open">
                <h2>فیلتر نتایج</h2>
                <span><i class="icon-down-open-1"></i></span>
            </header>
            <div class="content">
                <form id="wbsFilter" action="{{ route('dashboard.tourRequest') }}" method="get">
                    @csrf
                    <fieldset>
                        <label class="form-label">عنوان نمایشگاه</label>
                        <input type="text"
                               value="{{ request('title') }}"
                               name=" title"
                               class="form-control"/>
                    </fieldset>
                    <fieldset>
                        <label class="form-label">کشور</label>
                        <select data-url="{{ route('dashboard.getCountries') }}" id="country"
                                class="wbsAjaxSelect2"
                                name="country">
                            @if(!empty('$taxData') && !empty($taxData['country']))
                                <option selected
                                        value="{{ $taxData['country'][0] }}">{{ $taxData['country'][1] }}</option>
                            @endif
                        </select>
                    </fieldset>
                    <fieldset>
                        <label class="form-label">شهر</label>
                        <select multiple
                                {{ empty($taxData['city']) ? 'disabled' : '' }} data-url="{{ route('dashboard.getCites') }}"
                                id="city"
                                class="wbsAjaxSelect2"
                                name="city[]">
                            @if(!empty('$taxData') && !empty($taxData['city']))
                                @foreach($taxData['city'] as $key => $value)
                                    <option selected
                                            value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
                    </fieldset>
                    <fieldset>
                        <label class="form-label">حوزه</label>
                        <select multiple data-url="{{ route('dashboard.getGenre') }}" id="genre"
                                class="wbsAjaxSelect2"
                                name="genre[]">
                            @if(!empty('$taxData') && !empty($taxData['genre']))
                                @foreach($taxData['genre'] as $key => $value)
                                    <option selected
                                            value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
                    </fieldset>
                    <fieldset>
                        <label class="form-label">از تاریخ</label>
                        <input autocomplete="off" dir="ltr" type="text"
                               id="from_date"
                               name="from_date"
                               class="form-control" value="{{ verta(request('from_date_en')) }}"/>
                        <input dir="ltr" type="hidden"
                               id="from_date_en"
                               name="from_date_en"
                               class="form-control" value="{{ request('from_date_en') }}"/>
                    </fieldset>
                    <fieldset>
                        <label class="form-label">تا تاریخ</label>
                        <input autocomplete="off" dir="ltr" type="text"
                               id="to_date"
                               name="to_date"
                               class="form-control"/>
                        <input dir="ltr" type="hidden"
                               id="to_date_en"
                               name="to_date_en"
                               class="form-control"/>
                    </fieldset>
                    <fieldset>
                        <label class="form-label">وضعیت</label>
                        <select name="status" class="form-select">
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
                    <fieldset>
                        <label>عملیات</label>
                        <button type="submit" class="btn btn-primary">جستجو</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
