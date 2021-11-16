@extends('layouts.app')

@section('content')

    {{-- <!-- <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Course Selection
                </div>


                    <table style="float:right">
                        <tr>
                            @foreach($codes as $code)

                            <th>
                                <div class="card-body">

                                    <h3> <u> {{$code}} </u></h3>
                                    </form>
                                </div>
                            </th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach($names as $name)
                            <td>
                                <div class="card-body">

                                    <h5> {{$name}} </h5>
                                    </form>
                                </div>
                            </td>
                            @endforeach


                        </tr>
                        <tr>
                            @foreach($ids as $id)
                            <td>
                                <div class="card-body">
                                    <a class="btn btn-success" href="{{route('casestudy', ['course_id' => $id])}}">{{
                                        __('Next') }} </a>
                            </td>
                            @endforeach
                        </tr>
                    </table>
            
            </div>

        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Course Creation</h1>
                </div>

                <div class="card-body">
                    <form method="GET" action="course">
                        <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Create a New Course')
                            }} </button>
                    </form>
                </div>
            
            </div>
        </div>
    </div> --> --}}

    <div class="container">
        <div class="row">
            <div class="col-6 float-left">
                <h1>Courses</h1>
            </div>
            <div class="col-6 ">
                <!-- create course Button trigger modal -->
                <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#createCourseModal">
                    Create a course
                </button>
            </div>
        </div>
    </div>


    <!-- Create course Modal -->
    <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="createCourseModalLabel">Create a course</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form method="POST" action="{{ route('courses.store') }}">
                {{ csrf_field() }}
                <input type="hidden" id="user_id" name="user_id" value="{{$id}}">
                <div class="modal-body">
                
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="code">Course Code:</label>
                        <input type="text" id="code" name="code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="section">Number:</label>
                        <input type="number" id="number" name="number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="section">Section:</label>
                        <input type="number" id="section" name="section" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="text" id="year" name="year" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create">
                </div>
            </form>
        </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
           
            @if(count($courses)<1)
            
                <p>NO COURSES REGISTERED/CREATED</p>

            @else
                
                <div class="row">
                    
                
                    @for($i=0; $i<count($courses); $i++)
                        <div class="col-md-4 mt-5">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold ">{{$courses[$i]->code}}-{{$courses[$i]->number}} 00{{$courses[$i]->section}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{$courses[$i]->year}}</h6>
                                    <p class="card-text">{{$courses[$i]->title}}</p>

                                    <!-- Delete Button trigger modal -->
                                    <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteCourse{{$courses[$i]->id}}Modal">
                                        Delete
                                    </button>
                                    
                                    <!-- delete Modal -->
                                    <div class="modal fade" id="deleteCourse{{$courses[$i]->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="deleteCourse{{$courses[$i]->id}}ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCourse{{$courses[$i]->id}}ModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="{{route('courses.destroy', $courses[$i]->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                                <div class="modal-body">
                                                    Are you sure you want to delete this course?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>

                                    <!-- Edit course Button trigger modal -->
                                    <button type="button" class="mr-1 float-right btn btn-secondary" data-toggle="modal" data-target="#editCourse{{$courses[$i]->id}}Modal">
                                        Edit
                                    </button>

                                    

                                </div>
                            </div>
                        </div>
                        @if($i+1%3 === 0)  <!-- used to maintain 3x3 grid for course display -->
                            </div><div class="row">
                        @endif


                        <!-- edit course Modal -->
                        <div class="modal fade" id="editCourse{{$courses[$i]->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="editCourse{{$courses[$i]->id}}ModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editCourse{{$courses[$i]->id}}ModalLabel">Create a course</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>

                                <form method="POST" action="{{ route('courses.update', $courses[$i]->id) }}">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <div class="modal-body">
                                    
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" id="title" name="title" class="form-control" value="{{$courses[$i]->title}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="code">Course Code:</label>
                                            <input type="text" id="code" name="code" class="form-control" value="{{$courses[$i]->code}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="number">Number:</label>
                                            <input type="number" id="number" name="number" class="form-control" value="{{$courses[$i]->number}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="section">Section:</label>
                                            <input type="number" id="section" name="section" class="form-control" value="00{{$courses[$i]->section}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="year">Year:</label>
                                            <input type="text" id="year" name="year" class="form-control" value="{{$courses[$i]->year}}" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    @endfor
                </div>            

            @endif
        </div>
    </div>

    
   

@endsection