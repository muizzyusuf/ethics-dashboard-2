@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6 float-left">
                <h1>Courses</h1>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col">
           
            @if(count($courses)<1)

                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>No worries!</strong> You cannot see any courses becuase you have not been registered/assigned to a course yet!
                </div>

            @else
                
                <div class="row">
                    
                
                    @for($i=0; $i<count($courses); $i++)
                        <div class="col-md-4 mt-5">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold"><a href="{{route('courses.show', $courses[$i]->id)}}">{{$courses[$i]->code}}-{{$courses[$i]->number}} {{$courses[$i]->section}}</a></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{$courses[$i]->year}}</h6>
                                    <p class="card-text">{{$courses[$i]->title}}</p>
                                
                                    

                                </div>
                            </div>
                        </div>
                        @if($i+1%3 === 0)  <!-- used to maintain 3x3 grid for course display -->
                            </div><div class="row">
                        @endif

                    @endfor
                </div>            

            @endif
        </div>
    </div>

    
   

@endsection
