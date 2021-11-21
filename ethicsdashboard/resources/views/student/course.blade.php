@extends('layouts.app')

@section('content')
    <!-- course navigation -->
    <ul class="nav nav-tabs mb-2 justify-content-center">
        <li class="nav-item">
            <a class="nav-link font-weight-bold active" href="{{route('courses.show', $course->id)}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="{{route('courses.people', $course->id)}}">People</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="{{route('courses.grade', $course->id)}}">Grades</a>
        </li>
    </ul>

    <div class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col px-0">
                <h1 class="display-4">{{$course->code}}-{{$course->number}} 00{{$course->section}}</h1>
                <p class="lead my-3">{{$course->title}}</p>
                <p>{{$course->year}}</p>
                
            </div>

        </div>

    </div>

    <div class="container">
       
        <div class="card">
            <div class="card-header">Case Studies</div>
            @if(count($casestudies)<1)
                <p class="mx-auto mt-2 "><mark>NO CASE STUDIES CREATED YET</mark></p>
            @else
                <ul class="list-group list-group-flush">

                    @foreach($casestudies as $casestudy)
        
                        <li class="list-group-item">
                            <div class="float-left">
                                <p class="lead font-weight-bold"><a href="{{route('casestudy.show', $casestudy->id)}}">{{$casestudy->name}}</a></p>
                            </div>

                        </li>
        
                    @endforeach
        
                </ul>
            @endif
        </div>
        
    </div>

@endsection