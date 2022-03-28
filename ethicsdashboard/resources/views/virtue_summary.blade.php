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
        <a class="nav-link active" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="ml-5 mr-5 pl-5 pr-5 mb-2">
        <nav class="nav nav-pills nav-justified">
            <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Character</a>
            <a class="nav-link" href="{{route('virtuesection.show', $dashboard->virtue_section_id)}}">Vices and Virtues</a>
            <a class="nav-link btn-dark active" href="{{route('virtuesection.summary', $dashboard->virtue_section_id)}}">Summary</a>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            The Virtuous action is the one that balances the interests of the stakeholders in light of the relevant virtues. Note: This is just a rough approximation of how Virtue Ethics can be applied to a particular case. Practicing the virtues is a life-long endeavor - meaning that you would evaluate success/failure in consideration of the consequences, re-evaluate your decisions and refine your understanding of the virtues until virtuous actions flow from your character.
        </div>
      </div>

    <div>
        <div class="row">
            <div class="col">
                <div class="card border-secondary mt-2">
                    <p class="card-header font-weight-bold">Options Ranked by Most Virtuous</p>
                        <div class="card-body">  
                            <!-- User input of Vices and Virtues for all options-->
                            @if(count($optionVirtues)>0)
                                <form method="POST" action="{{route('virtue.store')}}">
                                    {{ csrf_field() }}
                                    {{method_field('POST')}}
                                    <input type="hidden" id="virtue_section_id" name="virtue_section_id"  value="{{$dashboard->virtue_section_id}}">
                                    @for($i=0; $i<count($optionVirtues); $i++)
                                        <div class="container border my-1 py-1 rounded">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold" for="option">Option :</label>
                                                <div>
                                                    <input type="text" class="form-control"  value="{{$optionVirtues[$i]->option->option}}" readonly>
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label font-weight-bold" for="option">Virtue :</label>
                                                <input type="text" class="form-control"  value="{{$optionVirtues[$i]->virtue}}" readonly>
                                            </div>
                        
                                            <div class="form-group">
                                                <small class="float-left text-muted">Virtue</small> <small class="float-right text-muted">Vice</small>
                                                <input type="range" min="0" max="9" class="form-control-range" value="{{abs($optionVirtues[$i]->value)}}" disabled >
                                            </div>
                                        </div>
                                    @endfor
            
                                </form>
                            @else
                                <p class="mx-auto mt-2 "><mark>NO VIRTUES/VICES HAVE BEEN SET FOR THE OPTIONS</mark></p>
                            @endif
                        </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-secondary mt-2">
                    <p class="card-header font-weight-bold">Interests Ranked by Most Virtuous</p>
                        <div class="card-body">  
                            <!-- User input of Vices and Virtues for all options-->
                            @if(count($stakeholderVirtues)>0)
                                <form method="POST" action="{{route('virtue.store')}}">
                                    {{ csrf_field() }}
                                    {{method_field('POST')}}
                                    
                                    <input type="hidden" id="virtue_section_id" name="virtue_section_id"  value="{{$dashboard->virtue_section_id}}">
                                    @for($i=0; $i<count($stakeholderVirtues); $i++)
                                        <div class="container border my-1 py-1 rounded">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold" for="stakeholder">Stakeholders Interest :</label>
                                                <div>
                                                    <textarea type="text" class="form-control" disabled >{{$stakeholderVirtues[$i]->stakeholder->interests}}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold" for="option">Virtue :</label>
                                                <input type="text" class="form-control"  value="{{$stakeholderVirtues[$i]->virtue}}" readonly>
                                            </div>
                                            
                        
                                            <div class="form-group">
                                                <small class="float-left text-muted">Virtue</small> <small class="float-right text-muted">Vice</small>
                                                <input type="range" min="0" max="9" class="form-control-range" value="{{abs($stakeholderVirtues[$i]->value)}}"  disabled >
                                            </div>
                                        </div>
                    
                                    @endfor
                                    
                                </form>
                            @else
                                <p class="mx-auto mt-2 "><mark>NO VIRTUES/VICES HAVE BEEN SET FOR THE STAKEHOLDER INTERESTS</mark></p>
                            @endif
                        </div>
                </div>
            </div>

        </div>
        
    </div>

    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">ETHICAL DECISION/
            COURSE OF ACTION </p>
    
    
        <div class="card-body">

            <form method="POST" action="{{route('virtuesection.decision',$virtueSection->id)}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <div class="form-group">
                    <label class="font-weight-bold" for="decision">Decision</label>
                    <textarea disabled class="form-control" id="decision" name="decision" rows="3" placeholder="Sum up your analysis. Eg. Wealth and prestige were desired by the most stakeholders, but they were not the most virtuous goals. Balancing the options and interests of stakeholders shows that the right thing will be a combination of courage, integrity and self-confidence.">{{$virtueSection->decision}}</textarea>
                </div>

               
            </form>
        </div>
       
        
    </div>
    
</div>

<div class="mt-3 card">
    <p class="card-header">Instructor Comments & Grade</p>
    <div class="card-body">
        <form method="POST" action="{{route('virtuesection.comment',$virtueSection->id)}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
    
            <div class="form-group">
                <label class="font-weight-bold" for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required> {{$virtueSection->comment}} </textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="grade">Grade</label>
                <input type="number" min="0" max="{{$casestudy->virtue_points}}" class="form-control col-1" id="grade" name="grade" value="{{$virtueSection->grade}}" required>
                <small id="help" class="form-text text-muted">Out of {{$casestudy->virtue_points}} </small>
            </div>

            <input type="submit" class="float-right btn btn-primary" value="Save">

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
            

        
            

                    
                    
                            
                       
                                






                            

                       