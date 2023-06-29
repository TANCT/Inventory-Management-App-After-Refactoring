@extends('merchandisers.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Merchandisers</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('merchandisers.create') }}"> Create New Merchandiser</a>
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
            <th>Phone</th>
            <th>Address</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($merchandisers as $merchandiser)
        <tr>
            <td>{{ $merchandiser->id }}</td>
            <td>{{ $merchandiser->name }}</td>
            <td>{{ $merchandiser->phone }}</td>
            <td>{{ $merchandiser->address }}</td>
            <td>
                <form action="{{ route('merchandisers.destroy',$merchandiser->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('merchandisers.show',$merchandiser->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('merchandisers.edit',$merchandiser->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {{ $merchandisers->links() }}


@endsection