@extends('layouts.tableview')

@section('create-button')
    @can('manage-branches')
        <a href="{{ route('branch.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus me-2"></i>Create Branch
        </a>
    @endcan
@endsection

@section('table-header')
    <tr>
        <th scope="col">Branch Name</th>
        <th scope="col">Location</th>
        <th scope="col">Actions</th>
    </tr>
@endsection

@section('table-body')
    @foreach ($branches as $branch)
        <tr>
            <td>{{ $branch->branch_name }}</td>
            <td>{{ $branch->branch_location }}</td>
            <td>
                <a href="{{ route('branch.show', $branch->branch_id) }}" class="btn btn-primary">
                    View Details
                </a>
                @can('manage-branches')
                    <a href="{{ route('branch.edit', $branch->branch_id) }}" class="btn btn-warning">
                    Edit
                </a>
                <form action="{{ route('branch.destroy', $branch->branch_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">
                        Delete
                    </button>
                </form>
                @endcan
            </td>
        </tr>
    @endforeach
@endsection