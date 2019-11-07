@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Super Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div>
                        Welcome {{ $datas[0]->user_name }}<br>
                        You've previliage of 
                        @foreach($datas as $data) 
                        </br>{{ $data->role_name }}  
                        @endforeach
                    </div>

                    @foreach($datas as $data)
                        <!-- <a href="{{ $data->user_id }}">{{ $data->user_id }}</a> -->
                    @endforeach

                        This is Super Admin Dashboard. You are super privileged to be here !
                </div>
            </div>
        </div>
    </div>
</div>
@endsection