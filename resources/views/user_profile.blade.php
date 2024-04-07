@extends('layout_user')
@section('content')

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ asset('profiles/' . $user->profile) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{ $user->fname }} {{ $user->lname }}</h5>
                        <form method="POST" action="{{ route('user_profile_image_update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="form-control" id="profile" name="profile">
                            <input type="submit" name="update" id="update" value="Update Profile Image" class="btn btn-primary btn-sm">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="album py-3" style="height:100vh;">
                            <div class="row justify-content-center align-items-center">
                                <div class="" style="max-width: 65rem;padding: 2%;">
                                    <h2>Account Details</h2>
                                    <hr>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('user_profile_update') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="fname" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="fname" name="fname" value="{{ $user->fname }}" required="">
                                                </div>
                                                <div class="col">
                                                    <label for="lname" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lname" name="lname" value="{{ $user->lname }}" required="">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="name@example.com" required="">
                                                </div>
                                                <div class="col">
                                                    <label for="contact" class="form-label">Contact Number</label>
                                                    <input type="tel" class="form-control" id="contact" name="contact" value="{{ $user->contact }}" placeholder="1234567890" required="">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="gender" class="form-label">Gender</label><br>
                                                    <input type="radio" id="gender" name="gender" value="Male" @if($user->gender =='Male') {{'checked'}} @endif>Male
                                                    <input type="radio" id="gender" name="gender" value="Female" @if($user->gender =='Female') {{'checked'}} @endif>Female
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea class="form-control" id="address" rows="3" name="address" placeholder="address" required="">{{ $user->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input type="submit" name="regist" id="regist" value="Update Profile" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">
                        <h5>My Orders</h5>
                    </div>
                    <div class="card-body text-center">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Shipping Charge</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lineitems as $lineitem)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $lineitem->productData->name }}</td>
                                    <td>{{ $lineitem->created_at }}</td>
                                    <td>₹ {{ $lineitem->price }}</td>
                                    <td>₹ {{ $lineitem->orderData->shipping }}</td>
                                    <td>{{ $lineitem->quantity }}</td>
                                    <td>₹ {{ $lineitem->total_price }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
