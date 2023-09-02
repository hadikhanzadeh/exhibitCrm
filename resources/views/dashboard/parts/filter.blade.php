<div class="row">
    <div class="col-12">
        <div class="wbs-panel">
            <header class="open">
                <h2>{{ __('Filter results') }}</h2>
                <span><i class="icon-down-open-1"></i></span>
            </header>
            <div class="content">
                <form id="wbsFilter" action="" method="get">
                    @csrf
                    @if(!in_array('exhibition_title',$excludeFields))
                        <fieldset>
                            <label class="form-label">{{ __('The title of the exhibition') }}</label>
                            <input type="text"
                                   value="{{ request('title') }}"
                                   name=" title"
                                   class="form-control"/>
                        </fieldset>
                    @endif
                    @if(!in_array('country',$excludeFields))
                        <fieldset>
                            <label class="form-label">{{ __('Country') }}</label>
                            <select data-url="{{ route('dashboard.getCountries') }}" id="country"
                                    class="wbsAjaxSelect2"
                                    name="country">
                                @if(!empty('$taxData') && !empty($taxData['country']))
                                    <option selected
                                            value="{{ $taxData['country'][0] }}">{{ $taxData['country'][1] }}</option>
                                @endif
                            </select>
                        </fieldset>
                    @endif
                    @if(!in_array('city',$excludeFields))
                        <fieldset>
                            <label class="form-label">{{ __('City') }}</label>
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
                    @endif
                    @if(!in_array('genre',$excludeFields))
                        <fieldset>
                            <label class="form-label">{{ __('Activity Area') }}</label>
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
                    @endif
                    @if(!in_array('date',$excludeFields))
                        <fieldset>
                            <label class="form-label">{{ __('From Date') }}</label>
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
                            <label class="form-label">{{ __('To Date') }}</label>
                            <input autocomplete="off" dir="ltr" type="text"
                                   id="to_date"
                                   name="to_date"
                                   class="form-control"/>
                            <input dir="ltr" type="hidden"
                                   id="to_date_en"
                                   name="to_date_en"
                                   class="form-control" value="{{ request('to_date_en') }}"/>
                        </fieldset>
                    @endif
                    @if(!in_array('status',$excludeFields))
                        <fieldset>
                            <label class="form-label">{{ __('Status') }}</label>
                            <select name="status" class="form-select">
                                <option value="0">{{ __('Select...') }}</option>
                                <option {{ request('status') === 'pending' ? 'selected': '' }} value="pending">
                                    {{ __('Pending') }}
                                </option>
                                <option {{ request('status') === 'awaiting' ? 'selected': '' }} value="awaiting">
                                    {{ __('Awaiting') }}
                                </option>
                                <option {{ request('status') === 'pending' ? 'complete': '' }} value="complete">
                                    {{ __('Completed') }}
                                </option>
                            </select>
                        </fieldset>
                    @endif
                    <fieldset>
                        <label>{{ __('Operation') }}</label>
                        <button type="submit" class="btn btn-primary">{{__('Search')}}</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
