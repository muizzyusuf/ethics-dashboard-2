@extends('layouts.app')

@section('content')

<!-- course navigation -->
<ul class="nav nav-tabs mb-2 justify-content-center">
    <li class="nav-item">
        <a class="nav-link font-weight-bold" href="{{route('courses.show', $course->id)}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link font-weight-bold" href="{{route('courses.people', $course->id)}}">People</a>
    </li>
    <li class="nav-item">
        <a class="nav-link font-weight-bold" href="{{route('courses.grade', $course->id)}}">Grades</a>
    </li>
</ul>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-5 font-weight-bold">{{$casestudy->name}}</h1>
        <hr>
        <p class="lead font-weight-bold">Points: {{$casestudy->points}}</p>
        <hr>
        <p>{{$casestudy->instruction}}</p>

    </div>

    <div class="container">

        
           
        
        <div class="card">
            <div class="card-header">Student Dashboards</div>
            @if(count($dashboards)<1)
                <div class="mt-4 container">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>No worries!</strong> You cannot see any student dashboards because students have not created any yet!
                    </div>
                </div>
                 
            @else

                @foreach($dashboards as $dashboard)
                    <ul class="list-group list-group-flush">
            
                        <li class="list-group-item">
                            <div class="">
                                <p class="lead font-weight-bold"><a href="{{route('dashboard.show', $dashboard->id)}}">{{$dashboard->name}}</a><br>
                                <small class="text-muted"><b>Student:</b> {{$dashboard->user_name}} | <b>Points:</b> {{$dashboard->grade}}/ {{$casestudy->points}}pts</small></p>
                            </div>
                            
                        </li>
            
                    </ul>

                    
                @endforeach
            
            @endif
        </div>
           
         

    </div>
</div>

@endsection