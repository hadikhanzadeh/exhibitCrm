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
                            <select id="country" class="wbsAjaxSelect2" name="country">
                                <option>asdasd</option>
                                <option>asdasd</option>
                                <option>asdasd</option>
                                <option>asdasd</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
