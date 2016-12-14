@extends('templates\template')

@section('content')

    <h1>{{$post->title}}</h1>
    <p>{{$post->description}}</p>

    @if($post->status == \App\Models\Post::POST_STATUS_PUBLISHED)
        <p><span class="label label-primary">Published</span></p>
    @elseif($post->status == \App\Models\Post::POST_STATUS_PENDING)
        <p><span class="label label-warning">Pending</span></p>
    @elseif($post->status == \App\Models\Post::POST_STATUS_SPAM)
        <p><span class="label label-danger">Spam</span></p>
    @endif

@endsection