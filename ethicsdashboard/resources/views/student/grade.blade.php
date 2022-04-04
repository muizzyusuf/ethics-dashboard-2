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

                    @foreach($casestudies as $case)
                        <tr>
                            <th scope="row"><a href="{{route('casestudy.show', $case->id)}}">{{$case->name}}</a></th>

                            @if($case->dashboard->where('user_id',Auth::user()->id)->first() != null)
                            
                                <td class="text-center">{{$case->dashboard->where('user_id',Auth::user()->id)->first()->grade}}</td>
                                
                            @else

                                <td class="text-center">0</td>

                            @endif
                            
                            <td class="text-center">{{$case->points}}</td>
                            
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
        
        
        
       

    </div>

   

@endsection