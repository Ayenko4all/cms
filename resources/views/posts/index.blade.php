@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
  <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
  </div>
  <div class="card card-default">
    <div class="card-header">Posts</div>
    <div class="card-body">
    @if($posts->count() > 0)
      <table class="table table-bordered">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Description</th>
          <th>Category</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($posts as $post)
         

          <tr>
            <td><img src="{{ asset('/storage/'.$post->image) }}" alt="" width="80px" height="60px"></td>
            <td>{{ $post->title}}</td>
            <td>{{ $post->description}}</td>
            <td>
              <a href="{{ route('categories.edit', $post->category->id) }}">
              {{ $post->category->name }}
              </a>
            </td>
            @if(!$post->trashed())
            <td>
              <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Edit</a>
            </td>
            @else
            <td>
              <form action="{{ route('restore-posts', $post->id) }}" method="post" >
                @csrf
                @method('PUT')
              <button type="submit" class="btn btn-info btn-sm">Restore</button>
              </form>
            </td>
            @endif
            <td>
              <form action="{{ route('posts.destroy' , $post->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">{{ route('trashed-posts.index') ? 'Delete' : 'Trash' }}</button>
              </form>
            </td>
          </tr>

       
        @endforeach
      </tbody>
      </table>
      @else
            <h3 class="text-center">No Post Yet</h3>
          @endif
    </div>
  </div>
@endsection