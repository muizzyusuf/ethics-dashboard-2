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
            <a class="nav-link btn-dark active" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Analysis</a>
            <a class="nav-link " href="{{route('caresection.summary', $dashboard->care_section_id)}}">Summary</a>
        </nav>
    </div>

    <div class="container mb-3">
        <div class="card">
            <div class="card-body">
                <div class="">Care ethics we come to understand the right thing to do by considering how we can care for others.  There are three main features of care that we can use to quantify this:
                    <ol>
                        <li>Attentiveness: Being aware of needs in others. </li>
                        <li>Competence: The ability to deliver what is needed.</li>
                        <li>Responsiveness: Empathy for the position of others in need of care.</li>
                    </ol>    
                
                </div>
            </div>
        </div>
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

                @if(count($options[$i]->cares)<1)
                    <form method="POST" action="{{route('care.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        <input type="hidden" id="id" name="id" value="{{$careSection->id}}" >
                        <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">

                        <div class="card-body">

                            @if(count($dashboard->stakeholderSection->stakeholders)<1)

                                <div class="container">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <strong>No stakeholder inputs have been made</strong> 
                                    </div>
                                </div> 
                                
                            @endif
                            
                            @for($j=0; $j<count($stakeholders); $j++)
                                    
                                <div class="container border my-1 py-1 rounded">
                                    <div class="form-group row mt-1">
                                        <label class="col-4 col-form-label" for="stakeholder">Stakeholder {{$j+1}}:</label>
                                        <input type="hidden" id="stakeholder{{$j+1}}_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" value="{{$stakeholders[$j]->stakeholder}}" readonly>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="text-center form-group col-md-4">
                                            <div>
                                                <label>Attentiveness:</label>
                                            </div>
                                            <small class="float-left text-muted" for="attentiveness">Low</small> <small class="float-right  text-muted" for="attentiveness">High</small>
                                            <input type="range" min="0" max="10" class="form-control-range " id="attentiveness{{$j+1}}" name="attentiveness{{$j+1}}" required>
                                            
                                        </div>
                                        <div class="text-center form-group col-md-4">
                                            <div>
                                                <label>Competence:</label>
                                            </div>
                                            <small class="float-left text-muted" for="competence">Low</small> <small class="float-right  text-muted" for="competence">High</small>
                                            <input type="range" min="0" max="10" class="form-control-range " id="competence{{$j+1}}" name="competence{{$j+1}}" required>
                                            
                                        </div>
                                        <div class="text-center form-group col-md-4">
                                            <div>
                                                <label>Responsiveness:</label>
                                            </div>
                                            <small class="float-left  text-muted" for="responsiveness">Low</small> <small class="float-right  text-muted" for="responsiveness">High</small>
                                            <input type="range" min="0" max="10" class="form-control-range " id="responsiveness{{$j+1}}" name="responsiveness{{$j+1}}" required>
                                            
                                        </div>
                                        
                                    </div> 
                                </div> 
                                
                            @endfor
                        </div>

                        @if(count($dashboard->stakeholderSection->stakeholders)>0)
                            <div class="container text-right form-group">                    
                                <input type="submit" class=" btn btn-primary" value="Save">   
                            </div>
                        @endif
                    </form>
                @else
                    <form method="POST" action="{{route('care.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        <input type="hidden" id="id" name="id" value="{{$careSection->id}}" >
                        <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">

                        <div class="card-body">
                            @for($j=0; $j<count($stakeholders); $j++)
                                    
                                <div class="container border my-1 py-1 rounded">
                                    <div class="form-group row mt-1">
                                        <label class="col-4 col-form-label" for="stakeholder">Stakeholder {{$j+1}}:</label>
                                        <input type="hidden" id="stakeholder{{$j+1}}_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                        <input type="hidden" id="care{{$j+1}}_id" name="care{{$j+1}}_id"  value=@foreach($stakeholders[$j]->cares as $c) @if($c->option_id == $options[$i]->id)  {{$c->id}} @endif @endforeach >
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" value="{{$stakeholders[$j]->stakeholder}}" readonly>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="text-center form-group col-md-4">
                                            <div>
                                                <label>Attentiveness:</label>
                                            </div>
                                            <small class="float-left text-muted" for="attentiveness">Low</small> <small class="float-right  text-muted" for="attentiveness">High</small>
                                            <input type="range" min="0" max="10" class="form-control-range " id="attentiveness{{$j+1}}" name="attentiveness{{$j+1}}" value=@foreach($stakeholders[$j]->cares as $c) @if($c->option_id == $options[$i]->id)  {{$c->attentiveness}} @endif @endforeach required>
                                            
                                        </div>
                                        <div class="text-center form-group col-md-4">
                                            <div>
                                                <label>Competence:</label>
                                            </div>
                                            <small class="float-left text-muted" for="competence">Low</small> <small class="float-right  text-muted" for="competence">High</small>
                                            <input type="range" min="0" max="10" class="form-control-range " id="competence{{$j+1}}" name="competence{{$j+1}}" value=@foreach($stakeholders[$j]->cares as $c) @if($c->option_id == $options[$i]->id)  {{$c->competence}}   @endif @endforeach required>
                                            
                                        </div>
                                        <div class="text-center form-group col-md-4">
                                            <div>
                                                <label>Responsiveness:</label>
                                            </div>
                                            <small class="float-left  text-muted" for="responsiveness">Low</small> <small class="float-right  text-muted" for="responsiveness">High</small>
                                            <input type="range" min="0" max="10" class="form-control-range " id="responsiveness{{$j+1}}" name="responsiveness{{$j+1}}" value=@foreach($stakeholders[$j]->cares as $c) @if($c->option_id == $options[$i]->id)  {{$c->responsiveness}}    @endif @endforeach required>
                                            
                                        </div>
                                        
                                    </div> 
                                </div> 
                                
                            @endfor
                        </div>
                        <div class="container text-right form-group">                    
                            <input type="submit" class=" btn btn-primary" value="Save">   
                        </div>
                    </form>
                @endif
            </div> 
                                                            
        @endfor
            
        
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