@extends('admin.layout')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Orders</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    All Orders
                </div>
                <div class="card-body">
                    @include('flash_data')
                    <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>User Name</th>
                                <th>Sub Total</th>
                                <th>Tax Rate</th>
                                <th>Tax Amount</th>
                                <th>Shipping</th>
                                <th>Total Amount</th>
                                <th>View lineitem</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Order Id</th>
                                <th>User Name</th>
                                <th>Sub Total</th>
                                <th>Tax Rate</th>
                                <th>Tax Amount</th>
                                <th>Shipping</th>
                                <th>Total Amount</th>
                                <th>View lineitem</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>LV- {{ $order->id }}</td>
                                    <td>{{ $order->customerData->full_name }}</td>
                                    <td>{{ $order->sub_total }}</td>
                                    <td>{{ $order->tax_rate }}</td>
                                    <td>{{ $order->tax_amount }}</td>
                                    <td>{{ $order->shipping }}</td>
                                    <td>{{ $order->amount }}</td>
                                   <td> <a href="{{ route('get_line_items', ['id' => $order->id]) }}"
                                           class="btn btn-sm btn-warning">View</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
