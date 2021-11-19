@extends('layouts.app')

@section('content')
<!-- {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Case Studies for {{$courseCode}}
                </div>


                <ul>
                    <table>
                        <tr>

                            @foreach($names as $name)

                            <th>
                                <div class="card-body">

                                    <h3> <u> {{$name}} </u></h3>

                                </div>
                            </th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach($points as $point)
                            <td>
                                <div class="card-body">

                                    <h5> Possible Points: {{$point}} </h5>

                                </div>
                            </td>
                            @endforeach


                        </tr>
                        <tr>
                            @foreach($ids as $id)
                            <td>
                                <div class="card-body">
                                    <a class="btn btn-success" href="{{route('casestudyInstr', ['id' => $id])}}">{{
                                        __('Next') }} </a>
                            </td>
            </div>
            @endforeach
            </tr>
            </table>



        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Case Study Creation</h1>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{route('csCreate', ['course_id' => $course_id])}}">
                        <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Create a New Case
                            Study') }} </button>
                    </form>
                </div>
                </ul>
            </div>
        </div>
    </div>
</div> --}} -->

<div class="container">
    <a class="mb-2 btn btn-dark" href="{{route('courses.show', $casestudy->course_id)}}">
        ⏴Case Studies
    </a> 
</div>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-5 font-weight-bold">{{$casestudy->name}}</h1>
        <hr>
        <p class="lead font-weight-bold">Points: {{$casestudy->points}}</p>
        <hr>
        <p>{{$casestudy->instruction}}</p>
        
        @if($dashboard === null)
            <p class="lead">
                <!-- create dashboard Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createDashboardModal">
                    Create an ethics dashboard
                </button>

                <!-- Modal -->
                <div class="modal fade" id="createDashboardModal" tabindex="-1" role="dialog" aria-labelledby="createDashboardModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
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
                                    <div class="form-group">
                                        <label for="title">Title of Dashboard:</label>
                                        <input type="text" id="name" name="name" class="form-control" required>
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
            </p>
        @endif

        @if($dashboard !== null)
            <div class="container">
        
                <div class="card">
                    <div class="card-header">My Dashboard</div>
                
                    <ul class="list-group list-group-flush">
            
                        <li class="list-group-item">
                            <div class="float-left">
                                <p class="lead font-weight-bold"><a href="{{route('dashboard.show', $dashboard->id)}}">{{$dashboard->name}}</a></p>
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
                            


                            <!-- edit case study Button trigger modal -->
                            <button type="button" class="mr-1 btn btn-secondary float-right" data-toggle="modal" data-target="#editDashboardModal">
                                Edit
                            </button>

                            <!-- edit case study Modal -->
                            <div class="modal fade" id="editDashboardModal" tabindex="-1" role="dialog" aria-labelledby="editDashboardModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editDashboardModalLabel">Edit Dashboard</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{route('dashboard.update', $dashboard->id)}}">
                                        {{ csrf_field() }}
                                        {{method_field('PUT')}}
                                        <input type="hidden" name="case_study_id" id="case_study_id" value="{{$casestudy->id}}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title">Title of Dashboard:</label>
                                                <input type="text" id="name" name="name" class="form-control" value="{{$dashboard->name}}" required>
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
            
            
                    </ul>
                    
                </div>
                
            </div>
        @endif

    </div>
</div>

@endsection