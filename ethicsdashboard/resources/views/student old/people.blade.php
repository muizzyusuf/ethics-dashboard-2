@extends('layouts.app')

@section('content')
    <!-- course navigation -->
    <ul class="nav nav-tabs mb-2 justify-content-center">
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="{{route('courses.show', $course->id)}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold active" href="{{route('courses.people', $course->id)}}">People</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="{{route('courses.grade', $course->id)}}">Grades</a>
        </li>
    </ul>

    
    <div class="container">

        <div class="jumbotron">
            
            <h1 class="display-5 font-weight-bold float-left">Everyone</h1>
              
            @if(count($people)>0)

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($people as $person)

                            <tr>
                                <th scope="row">{{$person->name}}</th>
                                <td>{{$person->email}}</td>
                                <td>{{$person->role}}</td>
                                
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>

            @endif
        </div>
        
       

    </div>

   

@endsection