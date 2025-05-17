@extends('layouts.tableview')

@section('create-button')
    @can('manage-users')
        <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus me-2"></i>Create User
        </a>
    @endcan
@endsection

@section('table-header')
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Branch</th>
        <th scope="col">Actions</th>
    </tr>
@endsection

@section('table-body')
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ optional($user->branch)->branch_name ?? 'Not Available' }}</td>
            <td>
                <a href="{{ route('user.show', $user->user_id) }}" class="btn btn-primary mb-2">
                    <i class="fas fa-eye"></i>
                </a>
                @can('manage-users')
                <a href="{{ route('user.edit', $user->user_id) }}" class="btn btn-warning mb-2">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('password.edit', $user->user_id) }}" class="btn btn-warning mb-2">
                    <i class="fas fa-key"></i>
                </a>
                @if (!Auth::user()->is($user))
                    <form action="{{ route('user.destroy', $user->user_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mb-2" onclick="return confirm('Are you sure you want to delete this booking?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                @endif
                @endcan
            </td>
        </tr>
    @endforeach
@endsection

@section('pagination')
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
@endsection