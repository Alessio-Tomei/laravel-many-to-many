@extends('layouts.base')

@section('title','post {{$post->id}}')

@section('content')
    @if ($post->image != null)
        <div>
            <img src="{{ asset('storage/' . $post->image) }}" alt="">
        </div>
    @else
        <p><span class="ms_bold">Image:</span> empty</p>
    @endif
    <p><span class="ms_bold">ID:</span> {{$post->id}}</p>
    <h3><span class="ms_bold">Title:</span> {{$post->title}}</h3>
    <p><span class="ms_bold">Content:</span> {{$post->content}}</p>
    <p><span class="ms_bold">Published:</span> {{$post->published}}</p>
    <p><span class="ms_bold">Slug:</span> {{$post->slug}}</p>
    <p><span class="ms_bold">Category:</span> {{$post->category ? $post->category->name : "-"}}</p>
    <p><span class="ms_bold">Tags:</span>
        @if ($post->tags->isNotEmpty())
            @foreach ($post->tags as $tag)
                {{' ' . $tag->name}}
            @endforeach
        @else
            {{' -'}}
        @endif
    </p>
    <a href="{{route("admin.posts.index")}}"><button type="button" class="btn btn-primary">back</button></a>
    <a href="{{route("admin.posts.edit", $post->id)}}"><button type="button" class="btn btn-warning">edit</button></a>
@endsection
