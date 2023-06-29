@extends('disposedproducts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Details</th>
            <th>Quantity</th>
            <th>Selling Price</th>
            <th>Discount (%)</th>
            <th>Clearance Sale</th>
          
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>{{ $product->quantity}}</td>
            <td>{{ $product->totalPrice }}</td>
            <td>{{ $product->discount }}</td>
            <td>@if($product->isClearance) Yes @else No @endif</td>
            
            
        </tr>
        @endforeach

    </table>
    {{ $products->links() }}


@endsection