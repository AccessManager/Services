@extends('Base::layout')
@section('header')
    Service Plans
@endsection

@section('breadcrumb')
    <li>
        <a href="">
            Dashboard
        </a>
    </li>
    <li>
        <a href="">
            Service Plans
        </a>
    </li>
    <li class="active">
        New Plan
    </li>
@endsection
@section('box-header')

    <p class="text-primary">
        new service plan
    </p>
@endsection

@section('content')
    {!! Form::open(['route'=>'plans.add.post','class'=>'form-horizontal']) !!}
    <div class="row">
        <div class="col-xs-7 col-xs-offset-2">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Define Service</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Apply Limits</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            {!! Form::text('name', NULL, ['class'=>'form-control','placeholder'=>'plan name']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            {!! Form::text('sim_sessions', NULL, ['class'=>'form-control','placeholder'=>'simultaneous sessions']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            {!! Form::text('interim_updates', NULL, ['class'=>'form-control','placeholder'=>'interim updates (in seconds)']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <div class="input-group">
                                                {!! Form::text('validity', NULL, ['class'=>'form-control','placeholder'=>'plan validity']) !!}
                                                <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                                                {!! Form::select('validity_unit', array_combine(\AccessManager\Constants\Time::TIME_DURATION_UNITS, \AccessManager\Constants\Time::TIME_DURATION_UNITS), NULL, ['class'=>'']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            {!! Form::text('price', NULL, ['class'=>'form-control','placeholder'=>'plan price']) !!}
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-md-12 ">

                                    <div class="form-group">
                                        <div class="col-md-7">
                                            <input
                                                    name="primary_policy_enabled"
                                                    value="1"
                                                    type="checkbox"
                                                    data-toggle="toggle"
                                                    data-label-text="Speed Limit"
                                            >
                                        </div>
                                        <div class="col-md-5" id="primary_policy_div">
                                            {!! Form::select('policy_id', $policies, NULL, ['class'=>'form-control','data-live-search'=>'true','title'=>'select primary policy',]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-7">
                                            <input
                                                    name="data_limit_enabled"
                                                    value="1"
                                                    type="checkbox"
                                                    data-toggle="toggle"
                                                    data-label-text="Data Limit"
                                            >
                                        </div>
                                        <div class="col-md-5" id="data_limit_div">
                                            <div class="input-group">
                                                {!! Form::text('data_limit', NULL, ['class'=>'form-control','placeholder'=>'data limit']) !!}
                                                <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                                                {!! Form::select('data_unit',array_combine(\AccessManager\Constants\Data::DATA_LIMIT_UNITS, \AccessManager\Constants\Data::DATA_LIMIT_UNITS), NULL, ['class'=>'']) !!}
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <div class="col-md-7">
                                        <input
                                                name="time_limit_enabled"
                                                value="1"
                                                type="checkbox"
                                                data-toggle="toggle"
                                                data-label-text="Time Limit"
                                        >
                                    </div>
                                    <div class="col-md-5" id="time_limit_div">
                                        <div class="input-group">
                                            {!! Form::text('time_limit', NULL, ['class'=>'form-control','placeholder'=>'time limit']) !!}
                                            <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                                            {!! Form::select('time_unit',array_combine(\AccessManager\Constants\Time::TIME_LIMIT_UNITS, \AccessManager\Constants\Time::TIME_LIMIT_UNITS), NULL, ['class'=>'']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-7">
                                        <input
                                                name="reset_every_enabled"
                                                value="1"
                                                type="checkbox"
                                                data-toggle="toggle"
                                                data-label-text="Limit Reset Cycle"
                                        >
                                    </div>
                                    <div class="col-md-5" id="reset_every_div">
                                        <div class="input-group">
                                            {!! Form::text('reset_every', NULL, ['class'=>'form-control','placeholder'=>'reset every']) !!}
                                            <div class="input-group-btn" >
                                                {!! Form::select('reset_every_unit', array_combine(\AccessManager\Constants\Time::TIME_DURATION_UNITS, \AccessManager\Constants\Time::TIME_DURATION_UNITS) , NULL, ['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" id="allow_aq_div">
                                    <div class="col-md-7">
                                        <input
                                                name="aq_policy_enabled"
                                                value="1"
                                                type="checkbox"
                                                data-toggle="toggle"
                                                data-label-text="Post Limit Speed"
                                        >
                                    </div>
                                    <div class="col-md-5" id="aq_policy_div">
                                        {!! Form::select('aq_policy_id', $policies, NULL, ['class'=>'form-control','data-live-search'=>'true','title'=>'select bandwidth policy',]) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
    </div>
@endsection

@section("box-footer")
    <div class="row">
        <div class="col-md-4 col-md-offset-3">
            <button class="btn btn-block bg-orange btn-flat">
                Submit
            </button>
        </div>
    </div>
    {!! Form::close() !!}
    @if( $errors->any() )
{{--        @foreach($errors->all() as $error)--}}
            {{$errors->first('name')}}
        {{--@endforeach--}}
    @endif
@endsection
@push("css")
{!! HTML::style("assets/css/bootstrap-switch-3.3.4.min.css") !!}
@endpush
@push('javascripts')
{!! HTML::script("assets/js/bootstrap-switch-3.3.4.min.js") !!}
{!! HTML::script("assets/js/service-plan-switches.js") !!}
@endpush