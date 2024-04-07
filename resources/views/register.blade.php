@extends('layout_user')
@section('content')


<div class="container-fluid">
<div class="album py-3" >
    <div class="row h-100 justify-content-center align-items-center">
        <div class="card border-success" style="max-width: 65rem;padding: 2%;">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <h2> Registration </h2>
            <hr>
            <div class="card-body">
                <form method="POST" action=" {{route('store_user')}} " enctype="multipart/form-data">
                @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder=""
                                   required="">
                        </div>
                        <div class="col">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder=""
                                   required="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="name@example.com" required="">
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                    required="">
                        </div>
                        <div class="col">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" name="contact"
                                   placeholder="1234567890" required="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="gender" class="form-label">Gender</label><br>
                            <input type="radio" id="gender" name="gender" value="Male" checked>Male
                            <input type="radio" id="gender" name="gender" value="Female">Female
                        </div>
                        
                    <div class="row mb-3">
                        <div class="col">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" rows="3" name="address"
                                      placeholder="address" required=""></textarea>
                        </div>
                        
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="profile" class="form-label">Profile</label><br>
                            <input type="file" class="form-control-file" name="profile" id="profile">
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <input type="submit" name="regist" id="regist" value="Register" class="btn btn-primary">
                    </div>
                </form>
                <div class="mb-3">
                        <a href="{{ route('login') }}" class="btn btn-success ">Already a User! Login</a>
                        
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection