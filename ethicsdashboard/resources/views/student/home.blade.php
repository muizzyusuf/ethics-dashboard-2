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
            
            <p class="mx-auto mt-2 "><mark>NO COURSES REGISTERED/CREATED</mark></p>

            @else
                
                <div class="row">
                    
                
                    @for($i=0; $i<count($courses); $i++)
                        <div class="col-md-4 mt-5">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold"><a href="{{route('courses.show', $courses[$i]->id)}}">{{$courses[$i]->code}}-{{$courses[$i]->number}} 00{{$courses[$i]->section}}</a></h5>
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
