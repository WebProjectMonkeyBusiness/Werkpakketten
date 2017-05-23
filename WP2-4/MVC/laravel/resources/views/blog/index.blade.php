@extends('layouts.master')

@section('content')
{{--
    //Je body moet tussen die apenstaartje sectionshit anders krijg je html errors
    <div class="row">
        <div class="col-md-12">
            <h1>Control Structures</h1>
            @if(true)
                <p>This only displays if true</p>
                @else
            <p>This only displays if false</p>
                @endif
            <hr>
          //Hr tag maakt een lijntje
            @for($i = 0; $i <5; $i++)
                <p> {{$i +1}}. Itertation</p>
                @endfor
            <hr>
            <h2>XSS</h2>
            {{"<script>alert('Hello');</script>"}}
            {!! "<script>alert('Hello');</script>" !!}

        </div>
    </div>--}}


<div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">

            <p class="quote">U heeft volgende items op uw lijst:</p>
        </div>
    </div>

@foreach($posts as $post)
    <div class="row">
        <div class="col-md-12 text-center">

            <h1 class="post-title">{{$post->title}}</h1>

            <p style="font-weight: bold">

                @foreach($post->tags as $tag)
                    - {{$tag->name}} -
                    @endforeach
            </p>

            <p>{{$post->content}}</p>
            <p><a href="{{ route('blog.post', ['id' => $post->id]) }}">Read more...</a></p>
         <input  type="button"  value="In progress"   onclick="this.value='Done'">
        </div>
    </div>
    <hr>
    @endforeach
    @endsection

