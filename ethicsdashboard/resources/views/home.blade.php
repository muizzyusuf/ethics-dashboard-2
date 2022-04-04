@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6 float-left">
                <h1>Courses</h1>
            </div>
            <div class="col-6 ">
                <!-- create course Button trigger modal -->
                <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#createCourseModal">
                    Create a Course
                </button>
            </div>
        </div>
    </div>


    <!-- Create course Modal -->
    <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="title">Title:</label>
                        <div class="col-10">
                            <input type="text" id="title" name="title" class="form-control" placeholder="e.g. Intro to Philosophy" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="code">Course Code:</label>
                        <div class="col-10">
                            <input type="text" id="code" name="code" class="form-control" placeholder="e.g. PHIL" maxlength="5" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="section">Number:</label>
                        <div class="col-10">
                            <input type="number" id="number" name="number" class="form-control" placeholder="e.g. 101" min="100" max="700" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="section">Section:</label>
                        <div class="col-10">
                            <input type="text" id="section" name="section" class="form-control" placeholder="e.g. 001" maxlength="3" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label" for="year">Year:</label>
                        <div class="col-10">
                            <input type="date" id="year" name="year" class="form-control" required>
                        </div>
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
            
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>No worries!</strong> You cannot see any courses becuase you have not created a course yet!
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
                                    
                                    <!-- Delete Button trigger modal -->
                                    <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteCourse{{$courses[$i]->id}}Modal">
                                        Delete
                                    </button>
                                    
                                    <!-- delete Modal -->
                                    <div class="modal fade" id="deleteCourse{{$courses[$i]->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="deleteCourse{{$courses[$i]->id}}ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCourse{{$courses[$i]->id}}ModalLabel">Delete {{$courses[$i]->code}}-{{$courses[$i]->number}}</h5>
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
                            <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editCourse{{$courses[$i]->id}}ModalLabel">Edit course</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>

                                <form method="POST" action="{{ route('courses.update', $courses[$i]->id) }}">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <div class="modal-body">

                                        <div class="form-group row">
                                            <label class="col-2 col-form-label" for="title">Title:</label>
                                            <div class="col-10">
                                                <input type="text" id="title" name="title" class="form-control" value="{{$courses[$i]->title}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label" for="code">Course Code:</label>
                                            <div class="col-10">
                                                <input type="text" id="code" name="code" class="form-control" value="{{$courses[$i]->code}}" maxlength="5" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label" for="section">Number:</label>
                                            <div class="col-10">
                                                <input type="number" id="number" name="number" class="form-control" value="{{$courses[$i]->number}}" min="100" max="700" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label" for="section">Section:</label>
                                            <div class="col-10">
                                                <input type="text" id="section" name="section" class="form-control" maxlength="3" value="{{$courses[$i]->section}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label" for="year">Year:</label>
                                            <div class="col-10">
                                                <input type="date" id="year" name="year" value="{{$courses[$i]->year}}" class="form-control" required>
                                            </div>
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

    
    <script type="text/javascript">
        $(document).ready(function () {
      
          $("form").submit(function () {
            // prevent duplicate form submissions
            $(this).find(":submit").attr('disabled', 'disabled');
            $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
      
          });
        });
      </script>

@endsection
