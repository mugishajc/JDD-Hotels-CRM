@extends('layouts.admin')
@php
    $profile=asset(Storage::url('avatar/'));
@endphp
@section('page-title')
    {{__('Profile')}}
@endsection
@push('css-page')
    <link href="{{ asset('assets/modules/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@push('script-page')
    <script src="{{ asset('assets/modules/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Profile')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Profile')}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-sidebar">
                            <div class="portlet light profile-sidebar-portlet ">
                                <div class="profile-userpic">
                                    <img alt="image" src="public/assets/img/avatar/avatar-3.jpg" class="img-responsive user-profile" class="img-responsive user-profile">
                                </div>
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name font-style"> {{$userDetail->name}}</div>
                                    <div class="profile-usertitle-job font-style"> {{$userDetail->type}}</div>
                                    <div class="profile-usertitle-job"> {{$userDetail->email}}</div>
                                </div>
                                <div class="profile-usermenu">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between w-100">
                                    <h4>{{__('Profile Account')}}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="setting-tab">
                                    <ul class="nav nav-pills mb-3" id="myTab3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#personal_info" role="tab" aria-controls="" aria-selected="true">{{__('Personal Info')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#change_password" role="tab" aria-controls="" aria-selected="false">{{__('Change Password')}}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent2">
                                        <div class="tab-pane fade show active" id="personal_info" role="tabpanel" aria-labelledby="home-tab3">
                                            {{Form::model($userDetail,array('route' => array('update.account'), 'method' => 'put', 'enctype' => "multipart/form-data"))}}
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{Form::label('name',__('Name'),array('class'=>'form-control-label'))}}
                                                        {{Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>_('Enter User Name')))}}
                                                        @error('name')
                                                        <span class="invalid-name" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    {{Form::label('email',__('Email'),array('class'=>'form-control-label'))}}
                                                    {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))}}
                                                    @error('email')
                                                    <span class="invalid-email" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""></div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                                        <div>
                                                            <span class="btn btn-primary btn-file">
                                                                <span class="fileinput-new"> {{__('Select image')}} </span>
                                                                <span class="fileinput-exists"> {{__('Change')}} </span>
                                                                <input type="hidden">
                                                                <input type="file" name="profile" id="logo">
                                                            </span>
                                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-right">
                                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">{{__('Cancel')}}</a>
                                                    @can('edit account')
                                                        {{Form::submit('Save Change',array('class'=>'btn btn-primary'))}}
                                                    @endcan
                                                </div>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                        <div class="tab-pane fade" id="change_password" role="tabpanel" aria-labelledby="profile-tab3">
                                            <div class="company-setting-wrap">
                                                {{Form::model($userDetail,array('route' => array('update.password',$userDetail->id), 'method' => 'put'))}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            {{Form::label('current_password',__('Current Password'),array('class'=>'form-control-label'))}}
                                                            {{Form::password('current_password',null,array('class'=>'form-control','placeholder'=>_('Enter Current Password')))}}
                                                            @error('current_password')
                                                            <span class="invalid-current_password" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{Form::label('new_password',__('New Password'),array('class'=>'form-control-label'))}}
                                                        {{Form::password('new_password',null,array('class'=>'form-control','placeholder'=>_('Enter New Password')))}}
                                                        @error('new_password')
                                                        <span class="invalid-new_password" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{Form::label('confirm_password',__('Re-type New Password'),array('class'=>'form-control-label'))}}
                                                        {{Form::password('confirm_password',null,array('class'=>'form-control','placeholder'=>_('Enter Re-type New Password')))}}
                                                        @error('confirm_password')
                                                        <span class="invalid-confirm_password" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-12 text-right">
                                                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">{{__('Cancel')}}</a>
                                                        {{Form::submit('Save Change',array('class'=>'btn btn-primary'))}}
                                                    </div>
                                                </div>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
