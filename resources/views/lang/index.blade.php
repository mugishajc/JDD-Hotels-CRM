@extends('layouts.admin')
@section('page-title')
    {{__('Manage Language')}}
@endsection
@push('css-page')
@endpush
@push('script-page')
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Language</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('Manage Language')}}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h4>{{__('Language')}}</h4>
                            <a href="#" class="btn btn-sm btn-warning"data-url="{{ route('create.language') }}" data-ajax-popup="true" data-title="{{__('Create New Language')}}">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861"><path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"/></svg>
                              </span>
                                {{__('Create')}}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="language-wrap">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 language-list-wrap">
                                    <div class="language-list">
                                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">

                                            @foreach($languages as $lang)
                                                <li class="nav-item">
                                                    <a  href="{{route('manage.language',[$lang])}}" class="nav-link {{($currantLang == $lang)?'active':''}}">{{Str::upper($lang)}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 language-form-wrap">
                                    <div class="language=form">
                                        <div class="tab-content no-padding" id="myTab2Content">
                                            <div class="tab-pane fade show active" id="lang1" role="tabpanel" aria-labelledby="home-tab4">


                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('Labels')}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('Messages')}}</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                        <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                                            @csrf
                                                            <div class="row">
                                                                @foreach($arrLabel as $label => $value)
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label" for="example3cols1Input">{{$label}} </label>
                                                                            <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                <div class="col-lg-12 text-right">
                                                                    <button class="btn btn-primary" type="submit">{{ __('Save Changes')}}</button>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                        <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                                            @csrf
                                                            <div class="row">
                                                                @foreach($arrMessage as $fileName => $fileValue)
                                                                    <div class="col-lg-12">
                                                                        <h3>{{ucfirst($fileName)}}</h3>
                                                                    </div>
                                                                    @foreach($fileValue as $label => $value)
                                                                        @if(is_array($value))
                                                                            @foreach($value as $label2 => $value2)
                                                                                @if(is_array($value2))
                                                                                    @foreach($value2 as $label3 => $value3)
                                                                                        @if(is_array($value3))
                                                                                            @foreach($value3 as $label4 => $value4)
                                                                                                @if(is_array($value4))
                                                                                                    @foreach($value4 as $label5 => $value5)
                                                                                                        <div class="col-md-6">
                                                                                                            <div class="form-group">
                                                                                                                <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                @else
                                                                                                    <div class="col-lg-6">
                                                                                                        <div class="form-group">
                                                                                                            <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @else
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @else
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label>{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>{{$fileName}}.{{$label}}</label>
                                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                            <div class="col-lg-12 text-right">
                                                                <button class="btn btn-primary" type="submit">{{ __('Save Changes')}}</button>
                                                            </div>
                                                        </form>
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
            </div>
        </div>
        </div>
    </section>
@endsection

