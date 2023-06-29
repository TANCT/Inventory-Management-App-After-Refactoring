@extends('merchandisers.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Merchandiser</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('merchandisers.index') }}">Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $merchandiser->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                {{ $merchandiser->phone }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                {{ $merchandiser->address }}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Order History</h2>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price per item (RM)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($merchandiser->orders as $order)
                    <tr>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price_per_product }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="2" class="text-right"><strong>Total:</strong></td>
                        <td>{{ $merchandiser->orders->sum('price_per_product') }}</td>
                    </tr>
               
            </tbody>
        </table>
    </div>
@endsection
