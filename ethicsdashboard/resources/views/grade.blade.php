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
        <div class="my-3 container text-right">
        
            <form method="POST" action="{{route('downloadGrades')}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <input type="hidden" id="id" name="id" value="{{$course->id}}" >                   
                <input type="submit" class=" btn btn-primary" value="Download Grades as PDF">   
                
            </form>
            
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Student Name</th>
                        @foreach($casestudies as $cs)
                            <th class="text-center" style="text-overflow: ellipsis;" scope="col">
                                <p>
                                    <a href="{{route('casestudy.show', $cs->id)}}">
                                        {{$cs->name}}
                                    </a> 
                                    <br>
                                    <small>Out of {{$cs->points}}</small>
                                </p>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>

                    

                    @foreach($students as $student)
    
                    <tr>
                        
                        <th scope="row">{{$student->name}}</th>

                        @foreach($casestudies as $case)

                            @if($case->dashboard->where('user_id',$student->id)->first() != null)
                            
                                <td class="text-center">{{$case->dashboard->where('user_id',$student->id)->first()->grade}}</td>
                            
                            @else

                                <td class="text-center">0</td>

                            @endif
                            
                            
                        @endforeach
                        
                    </tr>
                @endforeach

                    
                
                </tbody>
            </table>
        </div>
        
        
        
       

    </div>

   

@endsection