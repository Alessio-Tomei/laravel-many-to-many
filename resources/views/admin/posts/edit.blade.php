@extends('layouts.base')

@section('title','edit post')

@section('content')
    <h1>Edita post: {{$post->title}}</h1>  
    
    <form action="{{route("admin.posts.update", $post->id)}}" method="POST" enctype="multipart/form-data">
        
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo del post" value="{{old('title', $post->title)}}">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" placeholder="Inserisci il contenuto del post">{{old('content', $post->content)}}</textarea>
        </div>
        <div class="form-group">
            <label for="published">Published</label>
            <select class="form-control" id="published" name="published">
                <option>Choose...</option>'
                <option {{old('published', $post->published) == '1' ? 'selected' : ''}} value="1">True</option>
                <option {{old('published', $post->published) == '0' ? 'selected' : ''}} value="0">False</option>
            </select>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select class="form-control" id="categories" name="category_id">
                <option value="">-</option>
                @foreach ($categories as $category)
                    <option @if (old('category_id', $post->category_id) == $category->id) {{ 'selected' }} @endif value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-row ml-0">
            @foreach ($tags as $tag)
                <div class="form-group form-check mr-3">
                    <input class="form-check-input" type="checkbox" name="tags[]" 
                    value="{{$tag->id}}" 
                    id="{{$tag->slug}}" 
                    @if ($errors->any())
                        {{in_array($tag->id, old('tags', [])) ? " checked" : ""}}
                    @else
                        {{$post->tags->contains($tag) ? " checked" : ""}}
                    @endif
                    >
                    <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                </div>
            @endforeach
        </div>
        @if ($post->image != null)
            <div>
                <img src="{{ asset('storage/' . $post->image) }}" alt="">
            </div>
        @else
            <div>
                <p>Nessuna immagine</p>
            </div>
        @endif
        <div class="form-group">
            <label for="image">Scegli un file:</label>
            <input type="file" name="image" class="form-control-file" id="image">
        </div> 
        <a href="{{route("admin.posts.index")}}"><button type="button" class="btn btn-primary">back</button></a>
        <button type="submit" class="btn btn-success">save</button>
    </form>
    <form id="ms_delete-btn" action="{{route("admin.posts.destroy", $post->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo post?');">delete</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection