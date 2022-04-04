@extends('layouts.app')

@section('content')

<div>
    <a class="mb-2 btn btn-dark" href="{{route('casestudy.show', $dashboard->caseStudy->id)}}">
        ⏴Case Study
    </a> 
</div>

<div class="container mb-2">
    <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
        <a class="nav-link" href="{{route('dashboard.show', $dashboard->id)}}">Summary</a>
        <a class="nav-link" href="{{route('ethicalissue.show', $dashboard->ethical_issue_id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link active" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">
    <div class="container">

        <div class="row"> 
            <div class="col-md-9">
                <div class="row justify-content-around">
                    <div class="col-md-6 my-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                ETHICAL ISSUE & OPTIONS
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>

                                @if($ethicalissue->comment == null)

                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>Instructor is yet to make any comments for this section!</strong> 
                                        </div>
                                    </div> 

                                @else
                                    <p class="card-text text-muted">{{$ethicalissue->comment}}</p>             
                                @endif                                 
                                
                                    
                            </div>
                        </div>
                    </div>
        
                    <div class="col-md-6 my-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                STAKEHOLDERS & INTERESTS
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>

                                @if($stakeholderSection->comment == null)

                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>Instructor is yet to make any comments for this section!</strong> 
                                        </div>
                                    </div> 

                                @else
                                    <p class="card-text text-muted">{{$stakeholderSection->comment}}</p>             
                                @endif 
                                    
                            </div>
                        </div>
                    </div>
                        
                </div> 
                <br>
                <div class="row mt-3">
                    <div class="col-md-6 my-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                UTILITARIANISM
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>

                                @if($utilitarianismSection->comment == null)

                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>Instructor is yet to make any comments for this section!</strong> 
                                        </div>
                                    </div> 

                                @else
                                    <p class="card-text text-muted">{{$utilitarianismSection->comment}}</p>             
                                @endif 
                                
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 my-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                CARE ETHICS
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>

                                @if($careSection->comment == null)

                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>Instructor is yet to make any comments for this section!</strong> 
                                        </div>
                                    </div> 

                                @else
                                    <p class="card-text text-muted">{{$careSection->comment}}</p>             
                                @endif 
                                
                                    
                            </div>
                        </div>
                    </div>
        
                        
                </div> 
                <div class="row mt-3">
                    <div class="col-md-6 my-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                VIRTUE ETHICS
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>
                                @if($virtueSection->comment == null)

                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>Instructor is yet to make any comments for this section!</strong> 
                                        </div>
                                    </div> 

                                @else
                                    <p class="card-text text-muted">{{$virtueSection->comment}}</p>             
                                @endif 
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 my-2">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                DEONTOLOGY
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>
                                @if($deontologySection->comment == null)

                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>Instructor is yet to make any comments for this section!</strong> 
                                        </div>
                                    </div> 

                                @else
                                    <p class="card-text text-muted">{{$deontologySection->comment}}</p>             
                                @endif 
                                    
                            </div>
                        </div>
                    </div>
        
                        
                </div> 
                
            </div>
            <div class="col-md-3 align-self-center my-2">
                <div id="gradesSummary" class="card">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">TOTAL:&nbsp;{{$dashboard->grade}} / {{$dashboard->caseStudy->points}} pts</h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text font-weight-bold">Issue & Options: <span class="float-right">{{$ethicalissue->grade}} / {{$dashboard->caseStudy->issue_points}}  pts</span></p>
                        <p class="card-text font-weight-bold">Stakeholders: <span class="float-right">{{$stakeholderSection->grade}} / {{$dashboard->caseStudy->stakeholder_points}} pts</span></p>
                        <p class="card-text font-weight-bold">Utilitarianism: <span class="float-right">{{$utilitarianismSection->grade}} / {{$dashboard->caseStudy->util_points}} pts</span></p>
                        <p class="card-text font-weight-bold">Virtue Ethics: <span class="float-right">{{$virtueSection->grade}} / {{$dashboard->caseStudy->virtue_points}} pts</span></p>
                        <p class="card-text font-weight-bold">Care Ethics: <span class="float-right">{{$careSection->grade}} / {{$dashboard->caseStudy->care_points}} pts</span></p>
                        <p class="card-text font-weight-bold">Deontology: <span class="float-right">{{$deontologySection->grade}} / {{$dashboard->caseStudy->deontology_points}} pts</span></p>

                        <form method="POST" action="{{route('tasks')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        <input type="hidden" id="id" name="id" value="{{$dashboard->id}}" >                   
                                <input type="submit" class=" btn btn-primary" value="Export">   
                            
                        </form>
           
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>





@endsection
