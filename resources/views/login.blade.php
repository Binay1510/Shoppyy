@extends('layout_user')
@section('content')


<div class="container ">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5 " style="height: 460px;" >
                <div class="card-body"  >
                @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                    <h2 class="card-title text-center" >Login</h2>
                    <form action=" {{route('authenticate')}} " method="POST" name="loginForm" enctype="multipart/from-data">
                     
                    
                        <hr>
                        @csrf
                        {{ method_field('POST') }}
                        <div class="form-group">
                            <label for="emailInput">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   required="required" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="passInput">Password:</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   required="required" placeholder="Password">
                        </div>
                        <br>
                        <div>
                            <input type="submit" name="loginbtn" class="btn btn-success" value="Login">
                            <input type="reset" class="btn btn-danger">
                        </div>
                    </form>
                    <div class="mt-3 ">
                        <a href="{{ route('register') }}" class="btn btn-light btn-sm">New User? Register</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection    


    
