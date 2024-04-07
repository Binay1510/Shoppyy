@extends('layout_user')
@section('content')
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{  url('/products'). '/'. $product->image }}"
                                           alt="Product Image"/></div>
                <div class="col-md-6">
                    <div class="small mb-1">{{ $product->product_code }}</div>
                    <h1 class="display-5 fw-bolder">{{ $product->name  }}</h1>
                    <div class="fs-5 mb-5">
                        @if(empty($product->sale_price))
                            <span class="text-decoration-line-through">₹{{ $product->price }}</span>
                            <span>{{ '₹' . $product->sale_price }}</span>
                        @else
                            <span>{{ '₹' . $product->price }}</span>
                        @endif
                    </div>
                    <p class="lead">{{ $product->description }}</p>
                    <div class="d-flex">
                        <form method="post" action="{{ route('add_to_cart') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input class="form-control text-center me-3" id="inputQuantity" name="quantity" type="num" min="1" value="1"
                                   style="max-width: 3rem"/>
                            <input class="btn btn-outline-dark flex-shrink-0" type="submit" value="Add to cart" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    
   
@endsection
