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
        <a class="nav-link active" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="container mb-2">
        <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
            <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Option Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.impact', $dashboard->utilitarianism_section_id)}}">Stakeholder Analysis</a>
            <a class="nav-link btn-dark active" href="{{route('utilitarianismsection.aggregate', $dashboard->utilitarianism_section_id)}}">Pleasure Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.summary', $dashboard->utilitarianism_section_id)}}">Summary</a>
        </nav>
    </div>

    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">The Greatest Happiness Principle, actions are right if they 
            promote happiness (pleasure) and wrong if they promote 
            unhappiness (pain).  Consider the relative stakeholder 
            pleasures or pains for the options you identified. Identify 
            the pleasures as higher or lower by ticking the box. </p>

        @if(count($options)<1)
            <div class="card-body">
                <div class="container">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>No option inputs have been made</strong> 
                    </div>
                </div> 
            </div>  
        @endif
    
        @for($i=0; $i<count($options); $i++)
            <div class="card-body">

                <div class="form-group">
                    <label class="font-weight-bold" for="option">Option {{$i+1}}:</label>
                    <textarea class="form-control" id="option" name="option" rows="1" readonly>{{$options[$i]->option}} </textarea>
                </div>

                @if(count($options[$i]->consequences)>0 )
                    @foreach($consequences as $consequence)
                        @if(($consequence->option_id == $options[$i]->id))
                            

                            <div class="mb-2 card">
                                <div class="card-header">
                                    {{ucfirst($consequence->type)}}-Term Consequences
                                </div>
                                <div class="card-body">
                                    @if(count($consequence->pleasures)<1)
                                        <form method="POST" action="{{route('pleasure.store')}}">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <input type="hidden" id="id" name="id" value="{{$utilitarianismSection->id}}">
                                            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
                                            <input type="hidden" id="consequence_id" name="consequence_id" value="{{$consequence->id}}">

                                            @for($j=0; $j<count($stakeholders); $j++)
                                                <div class="container border my-2 pt-2 rounded">           
                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="stakeholder">Stakeholder {{$j+1}}:</label>
                                                        <input type="hidden" id="stakeholder{{$j+1}}_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                                        <textarea class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" rows="1" readonly>{{$stakeholders[$j]->stakeholder}}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-10">
                                                            <small class="float-left text-muted" for="pleasure">Pleasure</small> <small class="float-right text-muted" for="pleasure">Pain</small>
                                                            <input type="range" min="0" max="10" class="form-control-range" id="pleasure{{$j+1}}" name="pleasure{{$j+1}}" disabled required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <div class="form-check text-justify">
                                                                <input class="form-check-input" type="radio" name="level{{$j+1}}" id="level{{$j+1}}" value="High" readonly required>
                                                                <label class="form-check-label" for="level">High</label>
                                                            </div>
                                                            <div class="form-check text-justify">
                                                                <input class="form-check-input" type="radio" name="level{{$j+1}}" id="level{{$j+1}}" value="Low" readonly>
                                                                <label class="form-check-label" for="">Low</label>
                                                            </div>
                                                        </div>
                                                            
                                                    </div>
                                                    

                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="explanation">Explanation:</label>
                                                        <textarea class="form-control" id="explanation{{$j+1}}" name="explanation{{$j+1}}" rows="3" readonly></textarea>
                                                    </div>
                                                </div>  
                                                
                                                                

                                                    
                                            @endfor

                                        </form>
                                    @else 

                                        <form method="POST" action="{{route('pleasure.store')}}">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <input type="hidden" id="id" name="id" value="{{$utilitarianismSection->id}}">
                                            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
                                            <input type="hidden" id="consequence_id" name="consequence_id" value="{{$consequence->id}}">

                                            @for($j=0; $j<count($stakeholders); $j++)
                                                <div class="container border my-2 pt-2 rounded">      
                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="stakeholder">Stakeholder {{$j+1}}:</label>
                                                        <input type="hidden" id="stakeholde{{$j+1}}r_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                                        <textarea class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" rows="1" readonly>{{$stakeholders[$j]->stakeholder}}</textarea>
                                                    </div>

                                                    
                                                    @for($k=0; $k<count($pleasures); $k++)

                                                    
                                                        @if(($pleasures[$k]->consequence_id == $consequence->id) && ($pleasures[$k]->stakeholder_id == $stakeholders[$j]->id)  )
                                                            <div class="row">
                                                                
                                                                <div class="form-group col-md-10">
                                                                    <small class="float-left text-muted" for="pleasure">Pleasure</small> <label class="float-right text-muted" for="pleasure">Pain</small>
                                                                    <input type="range" min="0" max="10" class="form-control-range" id="pleasure{{$k+1}}" name="pleasure{{$k+1}}" value="{{$pleasures[$k]->pleasure}}" disabled required >
                                                                    <input type="hidden" id="pleasure{{$k+1}}_id" name="pleasure{{$k+1}}_id"  value="{{$pleasures[$k]->id}}">
                                                                </div>

                                                                @if($pleasures[$k]->level == 'High')
                                                                    <div class="form-group col-md-2">
                                                                        <div class="form-check text-justify">
                                                                            <input class="form-check-input" type="radio" name="level{{$k+1}}" id="level{{$k+1}}" value="High" checked readonly required>
                                                                            <label class="form-check-label" for="level">High</label>
                                                                        </div>
                                                                        <div class="form-check text-justify">
                                                                            <input class="form-check-input" type="radio" name="level{{$k+1}}" id="level{{$k+1}}" value="Low" readonly>
                                                                            <label class="form-check-label" for="">Low</label>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="form-group col-md-2">
                                                                        <div class="form-check text-justify">
                                                                            <input class="form-check-input" type="radio" name="level{{$k+1}}" id="level{{$k+1}}" value="High" readonly required>
                                                                            <label class="form-check-label" for="level">High</label>
                                                                        </div>
                                                                        <div class="form-check text-justify">
                                                                            <input class="form-check-input" type="radio" name="level{{$k+1}}" id="level{{$k+1}}" value="Low" readonly checked>
                                                                            <label class="form-check-label" for="">Low</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                    
                                                            </div>
                                                            

                                                            <div class="form-group">
                                                                <label class="font-weight-bold" for="explanation">Explanation:</label>
                                                                <textarea class="form-control" id="explanation{{$k+1}}" name="explanation{{$k+1}}" rows="3" required readonly>{{$pleasures[$k]->explanation}}</textarea>
                                                            </div>
                                                        @endif
                                                    @endfor
                                                    
                                                    
                                                                    

                                                </div>       
                                            @endfor

                                        </form>
                                    
                                    @endif
                                </div>
                            </div>

                        @endif
                        
                    @endforeach
                
                @else

                    <div class="mb-2 card">
                        <div class="card-body">
                            <div class="container">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>No long-term or short-term consequences have been inputed for this option</strong> 
                                </div>
                            </div> 
                        </div>  

                    </div>

                @endif
            </div>
        @endfor
        
    </div>


</div>

<div class="mt-3 card">
    <p class="card-header">Instructor Comments & Grade</p>
    <div class="card-body">
        <form method="POST" action="{{route('utilitarianismsection.comment', $utilitarianismSection->id)}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
    
            <div class="form-group row">
                <label class="font-weight-bold col-form-label col-3" for="comment">Comment:</label>
                <div class="col-9">
                    <textarea class="form-control" id="comment" name="comment" rows="3" required>{{$utilitarianismSection->comment}}</textarea>
                </div>
                
            </div>

            <div class="form-group row">
                <label class="font-weight-bold col-form-label col-3" for="grade">Grade:</label>
                <div class="col-9">
                    <input type="number" min="0" max="{{$dashboard->caseStudy->util_points}}" class="form-control" id="grade" name="grade" value="{{$utilitarianismSection->grade}}" required >
                    <small id="help" class="form-text text-muted">Out of {{$dashboard->caseStudy->util_points}} </small>
                </div>
                
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