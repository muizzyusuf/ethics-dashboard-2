@extends('layouts.app')

@section('content')

<div>
    <a class="mb-2 btn btn-dark" href="{{route('casestudy.show', $casestudy->id)}}">
        ⏴Case Study
    </a> 
</div>

<div class="container mb-2">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link active" href="{{route('dashboard.show', $dashboard->id)}}">Summary</a>
        <a class="nav-link" href="{{route('ethicalissue.show', $ethicalissue->id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.show', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">
    <div class="container">

        <div class="card mb-3">

            <form method="POST" action="{{route('dashboard.update', $dashboard->id)}}">
                {{ csrf_field() }}
                {{method_field('PUT')}}
                <input type="hidden" name="case_study_id" id="case_study_id" value="{{$casestudy->id}}">
                
                <div class="card-header">
                    <div class="form-group row mb-0">
                        <label class="col-3 col-form-label font-weight-bold" for="title">Title of Dashboard:</label>
                        <div class="col-9">
                            <input type="text" id="name" name="name" class="form-control" readonly value="{{$dashboard->name}}" required>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label font-weight-bold" for="summary">Case Summary:</label>
                        <div class="col-9">
                            <textarea class="form-control form-control" id="summary" name="summary" readonly rows="5" required>{{$dashboard->summary}} </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label font-weight-bold" for="dilemma">Identify the Dilemmas:</label>
                        <div class="col-9">
                            <textarea class="form-control form-control" id="dilema" name="dilemma" readonly rows="5" required>{{$dashboard->dilemma}} </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label font-weight-bold" for="role">Choose Your Role:</label>
                        <div class="col-9">
                            <input type="text" id="role" name="role" class="form-control" readonly value="{{$dashboard->role}}" required>
                        </div>
                    </div>
                </div>
            
                
            </form>

        </div>
        
        <div id="accordianId" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="ethicalIssueHeaderId">
                    <h5 class="mb-0">
                        <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#accordianId" href="#ethicalIssueContentId" aria-expanded="true" aria-controls="ethicalIssueContentId">
                            <b>Ethical Issue and Options</b>
                        </a>
                    </h5>
                </div>
                <div id="ethicalIssueContentId" class="collapse in" role="tabpanel" aria-labelledby="ethicalIssueHeaderId">
                    <div class="card-body">
                        @if(count($options)>0)
                            <p class="card-text"><b>Ethical Issue:</b> {{$ethicalissue->issue}}</p>
                            @for($i=0; $i<count($options); $i++)
                                
                                <p class="card-text"><b>Option {{$i+1}}:</b> {{$options[$i]->option}} </p>

                            @endfor
                        @else
                            <p class="card-text">No inputs have been made</p>                      
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="stakeholdersHeaderId">
                    <h5 class="mb-0">
                        <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#accordianId" href="#stakeholdersContentId" aria-expanded="true" aria-controls="stakeholdersContentId">
                           <b>Stakeholders and Interests </b>
                        </a>
                    </h5>
                </div>
                <div id="stakeholdersContentId" class="collapse in" role="tabpanel" aria-labelledby="stakeholdersHeaderId">
                    <div class="card-body">
                        @if(count($stakeholders)>0)
                            
                            @for($i=0; $i<count($stakeholders); $i++)
                                <p class="card-text"><b>Stakeholder {{$i+1}}:</b> {{$stakeholders[$i]->stakeholder}}</p>
                                <p class="card-text"><b>Interests:</b> {{$stakeholders[$i]->interests}} </p>
                                <br>
                            @endfor
                        @else
                            <p class="card-text">No inputs have been made</p>                      
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="utilHeaderId">
                    <h5 class="mb-0">
                        <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#accordianId" href="#utilContentId" aria-expanded="true" aria-controls="utilContentId">
                           <b>Utilitarianism </b>
                        </a>
                    </h5>
                </div>
                <div id="utilContentId" class="collapse in" role="tabpanel" aria-labelledby="utilHeaderId">
                    <div class="card-body">
                        @if($util->decision != null)
                            {{$util->decision}}
                        @else
                            <p class="card-text">No inputs have been made</p>       
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="careHeaderId">
                    <h5 class="mb-0">
                        <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#accordianId" href="#careContentId" aria-expanded="true" aria-controls="careContentId">
                           <b>Care Ethics </b>
                        </a>
                    </h5>
                </div>
                <div id="careContentId" class="collapse in" role="tabpanel" aria-labelledby="careHeaderId">
                    <div class="card-body">
                        @if($care->decision != null)
                            {{$care->decision}}
                        @else
                            <p class="card-text">No inputs have been made</p>       
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="virtueHeaderId">
                    <h5 class="mb-0">
                        <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#accordianId" href="#virtueContentId" aria-expanded="true" aria-controls="virtueContentId">
                           <b>Virtue Ethics </b>
                        </a>
                    </h5>
                </div>
                <div id="virtueContentId" class="collapse in" role="tabpanel" aria-labelledby="virtueHeaderId">
                    <div class="card-body">
                        @if($virtue->decision != null)
                            {{$virtue->decision}}
                        @else
                            <p class="card-text">No inputs have been made</p>       
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="deonHeaderId">
                    <h5 class="mb-0">
                        <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#accordianId" href="#deonContentId" aria-expanded="true" aria-controls="deonContentId">
                           <b>Deontology </b>
                        </a>
                    </h5>
                </div>
                <div id="deonContentId" class="collapse in" role="tabpanel" aria-labelledby="deonHeaderId">
                    <div class="card-body">
                        @if($deon->decision != null)
                            {{$deon->decision}}
                        @else
                            <p class="card-text">No inputs have been made</p>       
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




@endsection
