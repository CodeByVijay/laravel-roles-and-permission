@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="#" onclick="history.back()" class="btn btn-sm btn-primary">Back</a> {{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <p><b>Role : </b> <span>{{$role->name}}</span></p>
                        <p><b>Permissions : </b>

                            @foreach ($rolePermissions as $permission)
                            <span class="badge bg-success">{{$permission->name}}</span>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
