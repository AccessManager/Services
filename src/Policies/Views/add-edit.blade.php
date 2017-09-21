@extends('Base::layout')
@section('header')
    Bandwidth Policies
@endsection

@section('breadcrumb')
    <li>
        <a href="">
            Dashboard
        </a>
    </li>
    <li>
        <a href="{{route('policies.index')}}">
            Bandwidth Policies
        </a>
    </li>
    <li class="active">
        New Policy
    </li>
@endsection
@section('box-header')
    New Policy
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if( isset($policy) )
                {!! Form::model($policy, ['route'=>'policies.edit.post','class'=>'form-horizontal']) !!}
                {!! Form::hidden('id', $policy->id) !!}
            @else
                {!! Form::open(['route'=>'policies.add.post','class'=>'form-horizontal']) !!}
            @endif
            <fieldset>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-2">
                        {!! Form::text('name',NULL,['class'=>'form-control','placeholder'=>'new name..']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-2">
                        {!! Form::text('max_down', NULL, ['class'=>'form-control','placeholder'=>'maximum download']) !!}

                    </div>
                    <div class="col-md-2">
                        {!! Form::select('max_down_unit',array_combine(\AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS, \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS), NULL,['class'=>'form-control'] ) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-2">
                        {!! Form::text('min_down', NULL, ['class'=>'form-control','placeholder'=>'minimum download']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('min_down_unit',array_combine(\AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS, \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS), NULL,['class'=>'form-control'] ) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-2">
                        {!! Form::text('max_up', NULL, ['class'=>'form-control','placeholder'=>'maximum upload']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('max_up_unit',array_combine(\AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS, \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS), NULL,['class'=>'form-control'] ) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-2">
                        {!! Form::text('min_up', NULL, ['class'=>'form-control','placeholder'=>'minimum upload']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('min_up_unit',array_combine(\AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS, \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS), NULL,['class'=>'form-control'] ) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5 col-md-offset-4">
                        <div class="btn-group btn-group">
                            {!! Form::reset('Reset',['class'=>'btn btn-default']) !!}
                            {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </fieldset>
            {!! Form::close() !!}
        </div>
    </div>
@endsection