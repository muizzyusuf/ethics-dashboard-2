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
        <a class="nav-link font-weight-bold" href="{{route('courses.grade', $course->id)}}">Grades</a>
    </li>
</ul>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-5 font-weight-bold">{{$casestudy->name}}</h1>
        <hr>
        <p class="lead font-weight-bold">Points: {{$casestudy->points}}</p>
        <hr>
        <p>{{$casestudy->instruction}}</p>
        
        @if($dashboard === null)
            <div class="text-right">
                <!-- create dashboard Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createDashboardModal">
                    Create an ethics dashboard
                </button>

                <!-- Modal -->
                <div class="modal fade" id="createDashboardModal" tabindex="-1" role="dialog" aria-labelledby="createDashboardModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="createDashboardModalLabel">Create a dashboard</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{route('dashboard.store')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="case_study_id" id="case_study_id" value="{{$casestudy->id}}">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label" for="title">Title of Dashboard:</label>
                                        <div class="col-9">
                                            <input type="text" id="name" name="name" class="form-control" required>
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
            </div>
        @endif

        @if($dashboard !== null)
            <div class="container">
        
                <div class="card">
                    <div class="card-header">My Dashboard</div>
                
                    <ul class="list-group list-group-flush">
            
                        <li class="list-group-item">
                            <div class="float-left">
                                <p class="lead font-weight-bold"><a href="{{route('dashboard.show', $dashboard->id)}}">{{$dashboard->name}}</a></p>
                                <p><small class="font-weight-bold">{{$dashboard->grade}}/ {{$casestudy->points}}pts</small></p>
                            </div>

                            <!-- Delete Button trigger modal -->
                            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteDashboardModal">
                                Delete
                            </button>
                            
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteDashboardModal" tabindex="-1" role="dialog" aria-labelledby="deleteDashboardModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteDashboardModalLabel">Delete Dashboard</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{route('dashboard.destroy', $dashboard->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                            <input type="hidden" name="case_study_id" id="case_study_id" value="{{$casestudy->id}}">
                                            <div class="modal-body">
                                                Are you sure you want to delete this dashboard?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </li>
            
            
                    </ul>
                    
                </div>
                
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