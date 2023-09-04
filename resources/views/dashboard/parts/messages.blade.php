@if (\Session::has('success'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success">
                {!! \Session::get('success') !!}
            </div>
        </div>
    </div>
@endif
