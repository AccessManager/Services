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
    <li class="active">
        Bandwidth Policies
    </li>
@endsection

@section('content')

    <table class="table table-stripped table-hover table-responsive">
        <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $i= $policies->firstItem(); ?>
        @forelse( $policies as $policy )
            <tr>
                <td>{{$i}}</td>
                <td>{{$policy->name}}</td>
                <td>
                    <div class="btn-group btn-group-sm">

                        {!! Form::open(['route'=>'policies.delete']) !!}
                        {!! Form::hidden('id', $policy->id) !!}
                        <div class="btn-group btn-group-sm">
                            <a href="{{route('policies.edit',[$policy->id])}}" class="btn btn-default">
                                <i class="fa fa-pencil-square-o"></i> Modify
                            </a>
                            <button type="submit" class="btn btn-sm  btn-danger" onclick="return confirm('Are You Sure?')">
                                Delete
                            </button>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </td>
            </tr>
            <?php $i++; ?>
        @empty
            <tr>
                <td colspan="3">
                    No Records Found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <span class="pull-right">
        {!! $policies->links() !!}
    </span>
@endsection