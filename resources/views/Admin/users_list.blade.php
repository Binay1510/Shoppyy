@extends('admin.layout')
@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users List</h1>
        <ol class="breadcrumb mb-4">
            <!-- Breadcrumb content here -->
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->full_name}}</td>
                            <td>{{$user->role_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->contact}}</td>
                            <td>{{$user->gender}}</td>
                            
                            <td>
                                
                                <a href=" {{route('admin_change_user_status',['id'=>$user->id,'status'=>$user->is_active ==1?0:1])}} " class="btn  btn-sm btn-{{$user->is_active ==1? 'danger' : 'success'}}">{{$user->is_active ==1? 'Deactivate' : 'Active'}}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
