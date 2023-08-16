@extends('layouts.app')

@section('content')
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
                <div class="wbs-table wbs-panel">
                    <header>
                        <h2>نتایج</h2>
                        <div class="left-side">
                            asdsd
                        </div>
                    </header>
                    <div class="content">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان نمایشگاه</th>
                                <th>نام شرکت</th>
                                <th>نام مسئول</th>
                                <th>حوزه</th>
                                <th>شماره تماس</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>نمایشگاه تجهیزات خودرو</td>
                                <td>سازه های خودرویی ویستا</td>
                                <td>هادی خانزاده</td>
                                <td>تجهیزات خودرو</td>
                                <td>09368961858</td>
                                <td>عملیات های موردنظر</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>نمایشگاه تجهیزات خودرو</td>
                                <td>سازه های خودرویی ویستا</td>
                                <td>هادی خانزاده</td>
                                <td>تجهیزات خودرو</td>
                                <td>09368961858</td>
                                <td>عملیات های موردنظر</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>نمایشگاه تجهیزات خودرو</td>
                                <td>سازه های خودرویی ویستا</td>
                                <td>هادی خانزاده</td>
                                <td>تجهیزات خودرو</td>
                                <td>09368961858</td>
                                <td>عملیات های موردنظر</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
