@extends('layouts.app')

@section('content')

<div class="card card-default">
  <div class="card-header">
  @if(isset($post))
  Edit Post
  @else
  Create Post
  @endif
  </div>

  <div class="card-body">
    @include('partials.errors')
    <form action="{{ isset($post) ? route('posts.update',$post->id) : route('posts.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      @if(isset($post))
        @method('PUT')
      @endif
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title : '' }}">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->description : '' }}</textarea>
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <input type="hidden" id="content" name="content" value="{{ isset($post) ? $post->content : '' }}">
        <trix-editor input="content"></trix-editor>
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control">
          @foreach($categories as $category)
          <option value="{{ $category->id }}"

           @if(isset($post))

            @if($category->id == $post->category_id)

                selected

              @endif

           @endif

            >
            {{ $category->name}}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        @if($tags->count() > 0)
        <label for="tags">Tag</label>
        <select name="tags[]" id="tags" class="form-control tag-selector" multiple>

          @foreach($tags as $tag)
            <option value="{{ $tag->id }}"
             @if(isset($post))
              @if($post->hasTag($tag->id))
              selected
              @endif
             @endif
            >{{ $tag->name }}</option>
          @endforeach
          
        </select>
        @endif
      </div>
      <div class="form-group">
        <label for="published_at">Published At</label>
        <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
      </div>
      @if(isset($post))
        <div class="form-group">
        <img src="{{ asset('/storage/'.$post->image) }}" alt="" width="100%" height="100px">
        </div>
      @endif
      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ isset($post) ? 'Update Post' : 'Add Post' }}</button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  flatpickr('#published_at',{
    enableTime:true
  })

  // In your Javascript (external .js resource or <script> tag)
  $(document).ready(function() {
      $('.tag-selector').select2();
  });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
