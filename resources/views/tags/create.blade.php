@extends('layouts.app')


@section('content')

  <div class="card card-default">
    <div class="card-header">
      {{ isset($tag) ? 'Edit Tag': 'Create Tags' }}
    </div>
    <div class="card-body">
      @include('partials.errors')
      <form action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store') }}" method="post">
        @csrf
        @if(isset($tag))
        @method('PUT')
        @endif
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" class="form-control" name="name" value="{{ isset($tag) ? $tag->name : '' }}">
        </div>
        <div class="form-group">
          <button type="submitt" id="" class="btn btn-success" name=""> {{ isset($tag) ? 'Update Tag' : 'Add Tag'}}</button>
        </div>
      </form>
    </div>
  </div>

@endsection