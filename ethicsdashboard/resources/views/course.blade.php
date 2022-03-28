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
                <p class="lead">
                    <!-- create case study Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createCasestudyModal">
                        Create a case study
                    </button>
                </p>
            </div>

        </div>

        <!-- create case study Modal -->
        <div class="modal fade" id="createCasestudyModal" tabindex="-1" role="dialog" aria-labelledby="createCasestudyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCasestudyModalLabel">Create a Case Study</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('casestudy.store')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="course_id" id="course_id" value="{{$course->id}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Instruction:</label>
                            <textarea cols="30" rows="10" type="text" name="instruction" placeholder="Instructions.." class="form-control" required> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="code">Ethical Issue Section Points:</label>
                            <input type="number" id="issue_points" name="issue_points" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code"> Stakeholder Section Points:</label>
                            <input type="number" id="stakeholder_points" name="stakeholder_points" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Utilitarianism Section Points:</label>
                            <input type="number" id="util_points" name="util_points" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code"> Deontology Section Points:</label>
                            <input type="number" id="deontology_points" name="deontology_points" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code"> Virtue Ethics Section Points:</label>
                            <input type="number" id="virtue_points" name="virtue_points" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code"> Care Ethics Section Points:</label>
                            <input type="number" id="care_points" name="care_points" class="form-control" required>
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

                            <!-- Delete Button trigger modal -->
                            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteCasestudy{{$casestudy->id}}Modal">
                                Delete
                            </button>
                            
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteCasestudy{{$casestudy->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="deleteCasestudy{{$casestudy->id}}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteCasestudy{{$casestudy->id}}ModalLabel">Delete case study</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{route('casestudy.destroy', $casestudy->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                            <input type="hidden" name="course_id" id="course_id" value="{{$casestudy->course_id}}">
                                            <div class="modal-body">
                                                Are you sure you want to delete this case study?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            


                            <!-- edit case study Button trigger modal -->
                            <button type="button" class="mr-1 btn btn-secondary float-right" data-toggle="modal" data-target="#editCasestudy{{$casestudy->id}}Modal">
                                Edit
                            </button>

                             <!-- edit case study Modal -->
                            <div class="modal fade" id="editCasestudy{{$casestudy->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="editCasestudy{{$casestudy->id}}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCasestudy{{$casestudy->id}}ModalLabel">Edit Case Study</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{route('casestudy.update', $casestudy->id)}}">
                                        {{ csrf_field() }}
                                        {{method_field('PUT')}}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title">Name:</label>
                                                <input type="text" id="name" name="name" class="form-control" value="{{$casestudy->name}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Instruction:</label>
                                                <textarea cols="30" rows="10" type="text" name="instruction" class="form-control" required>{{$casestudy->instruction}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Ethical Issue Section Points:</label>
                                                <input type="number" id="issue_points" name="issue_points" class="form-control" value="{{$casestudy->issue_points}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="code"> Stakeholder Section Points:</label>
                                                <input type="number" id="stakeholder_points" name="stakeholder_points" class="form-control" value="{{$casestudy->stakeholder_points}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Utilitarianism Section Points:</label>
                                                <input type="number" id="util_points" name="util_points" class="form-control" value="{{$casestudy->util_points}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="code"> Deontology Section Points:</label>
                                                <input type="number" id="deontology_points" name="deontology_points" class="form-control" value="{{$casestudy->deontology_points}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="code"> Virtue Ethics Section Points:</label>
                                                <input type="number" id="virtue_points" name="virtue_points" class="form-control" value="{{$casestudy->virtue_points}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="code"> Care Ethics Section Points:</label>
                                                <input type="number" id="care_points" name="care_points" class="form-control" value="{{$casestudy->care_points}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="code">Total Points:</label>
                                                <input readonly type="number" id="points" name="points" class="form-control" value="{{$casestudy->points}}" required>
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
                        </li>
        
                    @endforeach
        
                </ul>
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