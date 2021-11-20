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
            <a class="nav-link font-weight-bold active" href="{{route('courses.grade', $course->id)}}">Grades</a>
        </li>
    </ul>

    
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Case Study</th>
                        <th class="text-center" scope="col">Grade</th>
                        <th class="text-center" scope="col">Out of</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($dboards as $dash)
                        <tr>
                            <th scope="row"><a href="{{route('casestudy.show', $dash->case_study_id)}}">{{$dash->name}}</a></th>
                            @if($dash->user_id == $student->id)
                                    <td class="text-center">{{$dash->grade}}</td>
                                    
                                    <td class="text-center">{{$dash->points}}</td>
                            @endif
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
        
        
        
       

    </div>

   

@endsection