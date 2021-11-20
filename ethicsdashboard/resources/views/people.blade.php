@extends('layouts.app')

@section('content')
    <!-- course navigation -->
    <ul class="nav nav-tabs mb-2 justify-content-center">
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="{{route('courses.show', $course->id)}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold active" href="{{route('courses.show', $course->id)}}">People</a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="#">Grades</a>
        </li>
    </ul>

    
    <div class="container">

        <div class="jumbotron">
            
            <h1 class="display-5 font-weight-bold float-left">Everyone</h1>
            
            <!-- add student Button trigger modal -->
            <button type="button" class="ml-2 btn btn-primary float-right" data-toggle="modal" data-target="#addStudentModal">
                Add Student
            </button>

            <!-- add student Modal -->
            <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel">Add Student to Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form method="POST" action="{{route('courseuser.store')}}">
                            {{ csrf_field() }}
                            {{method_field('POST')}}
                            <input type="hidden" name="course_id" id="course_id" value="{{$course->id}}">
                            <div class="modal-body">
                                <p>Check the box of any user you would like to add to the course</p>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                                @if($people->contains("id", $student->id)==false)
                                                    
                                                    <tr>
                                                        <td>{{$student->name}}</td>
                                                        <td>{{$student->email}}</td>
                                                        <td>
                                                            <input type="checkbox" value="{{$student->id}}" id="{{$student->id}}" name="user[]">
                                                        </td>
                                                        
                                                    </tr>

                                                @endif
                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- add student Button trigger modal -->
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addTAModal">
                Add Teaching Assistant
            </button>

            <!-- add student Modal -->
            <div class="modal fade" id="addTAModal" tabindex="-1" aria-labelledby="addTAModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTAModalLabel">Add Teaching Assistant to Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form method="POST" action="{{route('courseuser.store')}}">
                            {{ csrf_field() }}
                            {{method_field('POST')}}
                            <input type="hidden" name="course_id" id="course_id" value="{{$course->id}}">
                            <div class="modal-body">
                                <p>Check the box of any user you would like to add to the course</p>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teachingAssistants as $ta)
                                                @if($people->contains("id", $ta->id)==false)
                                                    
                                                    <tr>
                                                        <td>{{$ta->name}}</td>
                                                        <td>{{$ta->email}}</td>
                                                        <td>
                                                            <input type="checkbox" value="{{$ta->id}}" id="{{$ta->id}}" name="user[]">
                                                        </td>
                                                        
                                                    </tr>

                                                @endif
                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
              

            @if(count($people)>0)

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($people as $person)

                            <tr>
                                <th scope="row">{{$person->name}}</th>
                                <td>{{$person->email}}</td>
                                <td>{{$person->role}}</td>
                                <td>
                                    @if($person->role_id !== 1)
                                        <!-- remove user from course trigger modal -->
                                        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#removeUser{{$person->id}}Modal">
                                            Remove
                                        </button>
                                        
                                        <!-- remove user from course Modal -->
                                        <div class="modal fade" id="removeUser{{$person->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="removeUser{{$person->id}}ModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="removeUser{{$person->id}}ModalLabel">Remove User from Course</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="{{route('courseuser.destroy', [$course->id, $person->id])}}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{method_field('DELETE')}}
                                                        
                                                        <div class="modal-body">
                                                            Are you sure you want to remove this user from this course?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>

            @endif
        </div>
        
       

    </div>

   

@endsection