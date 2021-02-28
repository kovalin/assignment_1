@extends('Layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Business</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ URL::to('business/create') }}" title="Create a product"> <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>City</th>
            <th>Actions</th>
        </tr>
        @foreach ($businesses as $business)
            <tr>
                <td>{{ $business->id }}</td>
                <td>{{ $business->name }}</td>
                <td>{{ $business->price }}</td>
                <td>{{ $business->city }}</td>
                <td>
                    <form action="{{ route('business.destroy', $business->id) }}" method="POST">

                        <a href="{{ route('business.show', $business->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('business.edit', $business->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $businesses->links("pagination::bootstrap-4") !!}

@endsection
