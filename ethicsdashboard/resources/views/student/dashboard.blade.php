@extends('layouts.app')

@section('content')

<div>
    <a class="mb-2 btn btn-dark" href="{{route('casestudy.show', $casestudy->id)}}">
        ⏴Case Study
    </a> 
</div>

<div class="container mb-2">
    <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
        <a class="nav-link active" href="{{route('dashboard.show', $dashboard->id)}}">Summary</a>
        <a class="nav-link" href="{{route('ethicalissue.show', $ethicalissue->id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
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
                            <input type="text" id="name" name="name" class="form-control" value="{{$dashboard->name}}" required>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label font-weight-bold" for="summary">Case Summary:</label>
                        <div class="col-9">
                            <textarea class="form-control form-control" id="summary" name="summary" rows="5" placeholder="Briefly describe the key features of the case-the who, what, where, when and why." required>{{$dashboard->summary}} </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label font-weight-bold" for="dilemma">Identify the Dilemmas:</label>
                        <div class="col-9">
                            <textarea class="form-control form-control" id="dilema" name="dilemma" rows="5" placeholder="What are the ethical dilemmas you are facing? Desribe the dilemmas in ethical terms, e.g. Honest, deception, loyalty, betrayal, beneficence, malfeasence, autonomy, paternalism, confidentiality, transparency, integrity, etc." required>{{$dashboard->dilemma}} </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label font-weight-bold" for="role">Choose Your Role:</label>
                        <div class="col-9">
                            <input type="text" id="role" name="role" class="form-control" placeholder="Put yourself in the position of a key decision maker in the case" value="{{$dashboard->role}}" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                    
                </div>
                
            </form>

        </div>

        <div class="my-3 container">
            <p class="lead font-weight-bold">Summary of Inputs: <br>
                <small class="form-text text-muted">
                    Click the tabs below to see a summary of inputs/final ethical decisions for each dashboard section. 
                </small>
            </p>
            
        </div>
        
        <div id="accordianId" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="ethicalIssueHeaderId">
                    <h5 class="mb-0">
                        <a style="height:30px;" class="btn btn-light btn-block" data-toggle="collapse" data-parent="#accordianId" href="#ethicalIssueContentId" aria-expanded="true" aria-controls="ethicalIssueContentId">
                            <span class="float-left"><b>Ethical Issue and Options</b></span> <span class="float-right badge @if(count($options)>0) badge-success @else badge-danger @endif badge-pill">&nbsp;</span>
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
                            <div class="container">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>No inputs have been made</strong> 
                                </div>
                            </div>                         
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="stakeholdersHeaderId">
                    <h5 class="mb-0">
                        <a style="height:30px;" class="btn btn-light btn-block" data-toggle="collapse" data-parent="#accordianId" href="#stakeholdersContentId" aria-expanded="true" aria-controls="stakeholdersContentId">
                           <span class="float-left"><b>Stakeholders and Interests</b></span> <span class="float-right badge @if(count($stakeholders)>0) badge-success @else badge-danger @endif badge-pill">&nbsp;</span>
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
                            <div class="container">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>No inputs have been made</strong> 
                                </div>
                            </div>                       
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="utilHeaderId">
                    <h5 class="mb-0">
                        <a style="height:30px;" class="btn btn-light btn-block" data-toggle="collapse" data-parent="#accordianId" href="#utilContentId" aria-expanded="true" aria-controls="utilContentId">
                            <span class="float-left"><b>Utilitarianism</b></span> <span class="float-right badge @if($util->decision != null) badge-success @else badge-danger @endif badge-pill">&nbsp;</span>
                        </a>
                    </h5>
                </div>
                <div id="utilContentId" class="collapse in" role="tabpanel" aria-labelledby="utilHeaderId">
                    <div class="card-body">
                        @if($util->decision != null)
                        <p><b>Decision:</b> {{$util->decision}}</p>
                        @else
                            <div class="container">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>No inputs have been made</strong> 
                                </div>
                            </div>       
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="careHeaderId">
                    <h5 class="mb-0">
                        <a style="height:30px;" class="btn btn-light btn-block" data-toggle="collapse" data-parent="#accordianId" href="#careContentId" aria-expanded="true" aria-controls="careContentId">
                            <span class="float-left"><b>Care Ethics</b></span> <span class="float-right badge @if($care->decision != null) badge-success @else badge-danger @endif badge-pill">&nbsp;</span>
                        </a>
                    </h5>
                </div>
                <div id="careContentId" class="collapse in" role="tabpanel" aria-labelledby="careHeaderId">
                    <div class="card-body">
                        @if($care->decision != null)
                        <p><b>Decision:</b> {{$care->decision}}</p>
                        @else
                            <div class="container">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>No inputs have been made</strong> 
                                </div>
                            </div>         
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="virtueHeaderId">
                    <h5 class="mb-0">
                        <a style="height:30px;" class="btn btn-light btn-block" data-toggle="collapse" data-parent="#accordianId" href="#virtueContentId" aria-expanded="true" aria-controls="virtueContentId">
                            <span class="float-left"><b>Virtue Ethics</b></span> <span class="float-right badge @if($virtue->decision != null) badge-success @else badge-danger @endif badge-pill">&nbsp;</span>
                        </a>
                    </h5>
                </div>
                <div id="virtueContentId" class="collapse in" role="tabpanel" aria-labelledby="virtueHeaderId">
                    <div class="card-body">
                        @if($virtue->decision != null)
                        <p><b>Decision:</b> {{$virtue->decision}}</p>
                        @else
                            <div class="container">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>No inputs have been made</strong> 
                                </div>
                            </div>         
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="deonHeaderId">
                    <h5 class="mb-0">
                        <a style="height:30px;" class="btn btn-light btn-block" data-toggle="collapse" data-parent="#accordianId" href="#deonContentId" aria-expanded="true" aria-controls="deonContentId">
                            <span class="float-left"><b>Deontology</b></span> <span class="float-right badge @if($deon->decision != null) badge-success @else badge-danger @endif badge-pill">&nbsp;</span>
                        </a>
                    </h5>
                </div>
                <div id="deonContentId" class="collapse in" role="tabpanel" aria-labelledby="deonHeaderId">
                    <div class="card-body">
                        @if($deon->decision != null)
                        <p><b>Decision:</b> {{$deon->decision}}</p>
                        @else
                            <div class="container">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>No inputs have been made</strong> 
                                </div>
                            </div>      
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    
    <div class="mt-3 container text-left">
        
        <form method="POST" action="{{route('downloadPDF')}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
            <input type="hidden" id="id" name="id" value="{{$dashboard->id}}" >                   
            <input type="submit" class=" btn btn-primary" value="Download Summary as PDF">   
            
        </form>
        
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
