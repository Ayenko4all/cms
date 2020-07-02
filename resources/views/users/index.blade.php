@extends('layouts.app')

@section('content')

  <div class="card card-default">
    <div class="card-header">Users</div>
    <div class="card-body">
    @if($users->count() > 0)
      <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Action</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!$user->isAdmin())
              <form action="{{ route('users.make-admin') }}" method="post">
              @csrf
              <button class="btn btn-success btn-sm">Make Admin</button>
              </form>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
      </table>
      @else
            <h3 class="text-center">No User Yet</h3>
          @endif
    </div>
  </div>
@endsection