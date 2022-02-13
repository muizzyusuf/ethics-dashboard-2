@extends('layouts.app')

@section('content')

<div>
    <a class="mb-2 btn btn-dark" href="{{route('casestudy.show', $casestudy->id)}}">
        ⏴Case Study
    </a> 
</div>

<div class="container mb-2">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" href="{{route('dashboard.show', $dashboard->id)}}">Summary</a>
        <a class="nav-link" href="{{route('ethicalissue.show', $ethicalissue->id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.show', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link active" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">
    <div class="container">

        <div class="row"> 
            <div class="col-md-9">
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                ETHICAL ISSUE & OPTIONS
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>
                                <p class="card-text text-muted">{{$ethicalissue->comment}}</p>
                                    
                            </div>
                        </div>
                    </div>
        
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                STAKEHOLDERS & INTERESTS
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>
                                <p class="card-text text-muted">{{$stakeholderSection->comment}}</p>
                                    
                            </div>
                        </div>
                    </div>
                        
                </div> 
                <br>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                UTILITARIANISM
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>
                                <p class="card-text text-muted">{{$utilitarianismSection->comment}}</p>
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                CARE ETHICS
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>
                                <p class="card-text text-muted">{{$careSection->comment}}</p>
                                    
                            </div>
                        </div>
                    </div>
        
                        
                </div> 
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                VIRTUE ETHICS
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>
                                <p class="card-text text-muted">{{$virtueSection->comment}}</p>
                                    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                DEONTOLOGY
                            </div>
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold">Comments:</h6>
                                <p class="card-text text-muted">{{$deontologySection->comment}}</p>
                                    
                            </div>
                        </div>
                    </div>
        
                        
                </div> 
                
            </div>
            <div class="col-md-3 align-self-center">
                <div id="gradesSummary" class="card">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">TOTAL:&nbsp;{{$dashboard->grade}} / {{$casestudy->points}} pts</h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text font-weight-bold">Issue & Options: <span class="float-right">{{$ethicalissue->grade}} / {{$casestudy->issue_points}}  pts</span></p>
                        <p class="card-text font-weight-bold">Stakeholders: <span class="float-right">{{$stakeholderSection->grade}} / {{$casestudy->stakeholder_points}} pts</span></p>
                        <p class="card-text font-weight-bold">Utilitarianism: <span class="float-right">{{$utilitarianismSection->grade}} / {{$casestudy->util_points}} pts</span></p>
                        <p class="card-text font-weight-bold">Virtue Ethics: <span class="float-right">{{$virtueSection->grade}} / {{$casestudy->virtue_points}} pts</span></p>
                        <p class="card-text font-weight-bold">Care Ethics: <span class="float-right">{{$careSection->grade}} / {{$casestudy->care_points}} pts</span></p>
                        <p class="card-text font-weight-bold">Deontology: <span class="float-right">{{$deontologySection->grade}} / {{$casestudy->deontology_points}} pts</span></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




@endsection
