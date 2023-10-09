@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="#" onclick="history.back()" class="btn btn-sm btn-primary">Back</a>
                        {{ __('Role Edit') }}</div>

                    <div class="card-body">
                        <form action="{{ route('role.edit') }}" method="post">
                            @csrf
                            <input type="hidden" class="form-control" name="role_id" value="{{ $role->id }}">

                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" id="role" name="role" placeholder="Role"
                                    value="{{ $role->name }}">
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Permissions</label>
                                @foreach ($permission as $key => $row)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $row->name }}"
                                            id="flexCheckChecked{{ $key }}" name="permission[]"
                                            {{ in_array($row->id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked{{ $key }}">
                                            {{ $row->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('permission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
