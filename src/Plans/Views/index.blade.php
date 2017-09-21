@extends("Base::layout")
@section("header")
    Service Plans
@endsection
@section("content")
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        sr no.
                    </th>
                    <th>
                        name
                    </th>
                    <th>
                        validity
                    </th>
                    <th>
                        price
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $i = $plans->firstItem(); ?>
                @forelse($plans as $plan)
                    <tr>
                        <td>
                            {{$i++}}
                        </td>
                        <td>
                            {{$plan->name}}
                        </td>
                        <td>
                            {{$plan->validity}} {{$plan->valdity_unit}}
                        </td>
                        <td>
                            {{$plan->price}}
                        </td>
                    </tr>
                    @empty
                <tr>
                    <td colspan="4">
                        no records found.
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection