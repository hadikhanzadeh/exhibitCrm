<div class="row">
    <div class="col-12">
        <div class="wbs-panel">
            <header class="open">
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
                        <label class="form-label">از تاریخ</label>
                        <input dir="ltr" type="text"
                               id="from_date"
                               name="from_date"
                               class="form-control"/>
                        <input dir="ltr" type="hidden"
                               id="from_date_en"
                               name="from_date_en"
                               class="form-control"/>
                    </fieldset>
                    <fieldset>
                        <label class="form-label">تا تاریخ</label>
                        <input dir="ltr" type="text"
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
