@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Page1</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                       @foreach ($data as $dat)
                            {{$dat}}
                        @endforeach
                    This is User PAGE1. You must be privileged to be here !
                </div>
            </div>
        </div>
    </div>
</div>
@endsection