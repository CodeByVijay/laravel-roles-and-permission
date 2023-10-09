@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="#" onclick="history.back()" class="btn btn-sm btn-primary">Back</a>
                        {{ __('User Edit') }}</div>

                    <div class="card-body">
                        <form action="{{ route('user.edit') }}" method="post">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                    value="{{ $user->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="con_password">Password</label>
                                <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Confirm Password">
                                @error('con_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="roles">Roles</label>
                                <select name="roles[]" id="roles" class="form-control" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}" {{in_array($role->name, $userRole) ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="btn">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
