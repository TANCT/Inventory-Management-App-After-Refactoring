@extends('staffs.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Staffs</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('staffs.create') }}"> Create New Staff</a>
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
        @foreach ($staffs as $staff)
        <tr>
            <td>{{ $staff->id }}</td>
            <td>{{ $staff->name }}</td>
            <td>{{ $staff->phone }}</td>
            <td>{{ $staff->address }}</td>
            <td>
                <form action="{{ route('staffs.destroy',$staff->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('staffs.show',$staff->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('staffs.edit',$staff->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {{ $staffs->links() }}


@endsection