@extends('templates\template')

@section('content')

    <h1>Create Job</h1>
    <p>Create a job post</p>

    @if(isset($errors) && count($errors)> 0)
        @foreach($errors as $error)
        <div class="alert-danger alert-dismissable alert"> {{$error}}</div>
        @endforeach
    @endif

    <form method="post" action="{{\Core\Helper::makeUrl('post/post')}}">
        <div class="form-group col-lg-6">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>

        <div class="form-group col-lg-6">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
        </div>

        <div class="form-group col-lg-12">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description"></textarea>
        </div>

        <div class="form-group col-lg-6">
            <input type="submit" class="btn btn-primary" value="Post job">
        </div>
    </form>

@endsection