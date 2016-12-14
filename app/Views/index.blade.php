@extends('templates\template')


@section('content')
    <div class="page-header">
        <h1>Jobs Posted <small>job listing</small></h1>
    </div>

    @if(count($posts)> 0)
        @foreach($posts as $post)
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{\Core\Helper::makeUrl("post/show/".$post->id)}}"> {{$post->title}}</a></div>
                <div class="panel-body">
                    {{$post->description}}
                </div>
            </div>
        @endforeach
    @else
    No jobs found
    @endif
@endsection