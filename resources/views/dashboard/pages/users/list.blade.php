@extends('layouts.app')

@section('content')
    @include('dashboard.parts.messages')

    <div class="row">
        <div class="col-12">
            <div class="title">
                <h1>{{ __('Users') }}</h1>
                <a class="btn btn-primary"
                   href="{{ route('dashboard.createUser') }}">{{ __('Create User') }}</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-12">
            <div class="main-content">
                <div class="content">
                    <table
                        class="table wbs-profile-table table-borderless table-head-bg">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Full Name') }}</th>
                            <th>{{__('Email')}}</th>
                            <th> {{ __('Role') }}</th>
                            <th>{{ __('Operation') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$users->isEmpty())
                            @php
                                $i = 1;
                            @endphp
                            @foreach($users as  $user)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role === 'administrator' ? 'مدیرکل' : 'کارشناس پشتیبانی' }}</td>
                                    <td class="action">
                                        <a href="{{ route('dashboard.viewUser',$user->id) }}"><i
                                                class="icon-eye-2"></i></a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach()
                        @else
                            <tr>
                                <td colspan="10" class="text-center">
                                    {{ __('Nothing found!') }}
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
