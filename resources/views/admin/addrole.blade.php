@extends('layouts.sketchadmin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Permission</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Admin Permission</th>
                <th>Supervisor Permission</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                @foreach($user->roles as $role)
                    <td>{{ $role->name }}</td>
                @endforeach
                <td>
                    @if($user->id != Auth::user()->id)
                        @if($user->hasRole('admin'))
                            <a class="btn btn-danger" href="/admin/remove-admin/{{$user->id}}">
                                Remove
                            </a>
                        @else
                            <a class="btn btn-info" href="/admin/give-admin/{{$user->id}}">
                                Allow
                            </a>
                        @endif
                    @endif
                    </td>
                <td>
                    @if($user->id != Auth::user()->id)
                        @if($user->hasRole('supervisor'))
                            <a class="btn btn-danger" href="/admin/remove-supervisor/{{$user->id}}">
                                Remove
                            </a>
                        @else
                            <a class="btn btn-info" href="/admin/give-supervisor/{{$user->id}}">
                                Allow
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</section>
<!-- /.main content -->

@endsection
