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
        <a class="nav-link active" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="ml-5 mr-5 pl-5 pr-5 mb-2">
        <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
            <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Analysis</a>
            <a class="nav-link  btn-dark active" href="{{route('caresection.summary', $dashboard->care_section_id)}}">Summary</a>
        </nav>
    </div>
   
    <div class="container">
        @if(count($dashboard->ethicalIssue->options)<1)

            <div class="container">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>No option inputs have been made</strong> 
                </div>
            </div> 
                              
        @endif 

        @for($i=0; $i<count($options); $i++)

            <div class="card mb-2">
                <div class="card-header font-weight-bold">
                    Option {{$i+1}}: {{$options[$i]->option}}
                </div>

                @if(count($options[$i]->cares)>0)
                   
                    <div class="card-body">
                        <form method="POST" >
                            <div class="form-group">
                                <label class="label">Duty of Care:</label>
                                                               
                                <input type="range" min="0" max="10" class="form-control-range" value={{ ($options[$i]->cares->avg('attentiveness') + $options[$i]->cares->avg('competence') + $options[$i]->cares->avg('responsiveness'))/3 }} disabled required>
                            
                            </div>
                        </form>
                    </div>
                    
                @else
                    
                        <div class="card-body">
                            <div class="container">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>Care analysis not done!</strong> 
                                </div>
                            </div> 
                        </div>
                     
                @endif
            </div> 
                                                            
        @endfor
            
        
    </div>
  
    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">ETHICAL DECISION/
            COURSE OF ACTION </p>
    
    
        <div class="card-body">

            <form method="POST" action="{{route('caresection.decision',$careSection->id)}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <div class="form-group">
                    <label class="font-weight-bold" for="decision">Decision</label>
                    <textarea class="form-control" id="decision" name="decision" rows="3" placeholder="The option that results in a high level duty of care is the moral choice">{{$careSection->decision}}</textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="float-right btn btn-primary" value="Save">
                </div>
            </form>
        </div>
       
        
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