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
        <a class="nav-link active" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">
    <div class="card border-secondary">
        <p class="card-header font-weight-bold">Utilitarianism is a consequentialist theory – meaning that the 
            moral worth of an action is determined by the consequences 
            of the action.  The first step is to consider the consequences, 
            both short-term and long-term, for the options you’ve 
            identified.</p>

        @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                <form method="POST" action="{{route('consequence.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$utilitarianismSection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                        <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>
                    </div>
                    
                    @if(count($options[$i]->consequences)>0 )
                        @foreach($consequences as $consequence)
                            @if(($consequence->option_id == $options[$i]->id) && ($consequence->type == 'short'))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="short">Short Term Consequence</label>
                                    <input type="hidden" id="short_id" name="short_id" value="{{$consequence->id}}">
                                    <textarea class="form-control" id="short" name="short" rows="3" required>{{$consequence->consequence}}</textarea>
                                </div>

                            @elseif(($consequence->option_id == $options[$i]->id) && ($consequence->type == 'long'))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="long">Long Term Consequence</label>
                                    <input type="hidden" id="long_id" name="long_id" value="{{$consequence->id}}">
                                    <textarea class="form-control" id="long" name="long" rows="3" required>{{$consequence->consequence}}</textarea>
                                </div>
                            @endif
                            
                        @endforeach
                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                    @else
                    
                        <div class="form-group">
                            <label class="font-weight-bold" for="short">Short Term Consequence</label>
                            <textarea class="form-control" id="short" name="short" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="long">Long Term Consequence</label>
                            <textarea class="form-control" id="long" name="long" rows="3" required> </textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                
                    @endif
                    

                </form>
            </div>
        @endfor
        
    </div>

    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">Provide reasons why you have included each stakeholder. 
            Make sure to rank them according to the degree of impact. </p>
    
        @for($i=0; $i<count($stakeholders); $i++)
            <div class="card-body">
                
                <form method="POST" action="{{route('impact.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$utilitarianismSection->id}}" >

                    
                    <div class="form-group">
                        <label class="font-weight-bold" for="stakeholder">Stakeholder {{$i+1}}</label>
                        <input type="hidden" id="stakeholder_id" name="stakeholder_id" @if(isset($stakeholders[$i])) value="{{$stakeholders[$i]->id}}" @endif>
                        <textarea class="form-control" id="stakeholder" name="stakeholder" rows="1" readonly>@if(count($stakeholders)>0) {{$stakeholders[$i]->stakeholder}} @endif </textarea>
                    </div>
                    
                    @if($stakeholders[$i]->impact != null)
                        @foreach($impacts as $impact)
                            @if($impact->stakeholder_id == $stakeholders[$i]->id)
                            <div class="row">
                                <div class="form-group col-md-11">
                                    <label class="font-weight-bold" for="impact">Impact</label>
                                    <input type="hidden" id="impact_id" name="impact_id" value="{{$impact->id}}">
                                    <textarea class="form-control" id="impact" name="impact" rows="3" required>{{$impact->impact}}</textarea>
                                </div>

                                <div class="form-group col-md-1">
                                    <label class="font-weight-bold" for="rank">Rank</label>
                                    <input type="number" class="form-control" id="rank" name="rank" min="1" max="6" value="{{$impact->rank}}" required >
                                </div>
                            </div>
                                

                            @endif
                            
                        @endforeach
                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                    @else
                        <div class="row">
                            <div class="form-group col-md-11">
                                <label class="font-weight-bold" for="impact">Impact</label>
                                <textarea class="form-control" id="impact" name="impact" rows="3" required></textarea>
                            </div>

                            <div class="form-group col-md-1">
                                <label class="font-weight-bold" for="rank">Rank</label>
                                <input type="number" class="form-control" id="rank" name="rank" min="1" max="6" required >
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                
                    @endif
                    

                </form>
            </div>
        @endfor
        
    </div>

    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">The Greatest Happiness Principle, actions are right if they 
            promote happiness (pleasure) and wrong if they promote 
            unhappiness (pain).  Consider the relative stakeholder 
            pleasures or pains for the options you identified. Identify 
            the pleasures as higher or lower by ticking the box. </p>
    
        @for($i=0; $i<count($options); $i++)
            <div class="card-body">

                <div class="form-group">
                    <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
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
                                                        
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="stakeholder">Stakeholder {{$j+1}}</label>
                                                    <input type="hidden" id="stakeholder{{$j+1}}_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                                    <textarea class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" rows="1" readonly>{{$stakeholders[$j]->stakeholder}}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-10">
                                                        <label class="float-left font-weight-bold text-muted" for="pleasure">Pleasure</label> <label class="float-right font-weight-bold text-muted" for="pleasure">Pain</label>
                                                        <input type="range" min="0" max="10" class="form-control-range" id="pleasure{{$j+1}}" name="pleasure{{$j+1}}" required>
                                                        
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <div class="form-check text-justify">
                                                            <input class="form-check-input" type="radio" name="level{{$j+1}}" id="level{{$j+1}}" value="High" required>
                                                            <label class="form-check-label" for="level">High</label>
                                                        </div>
                                                        <div class="form-check text-justify">
                                                            <input class="form-check-input" type="radio" name="level{{$j+1}}" id="level{{$j+1}}" value="Low">
                                                            <label class="form-check-label" for="">Low</label>
                                                        </div>
                                                    </div>
                                                        
                                                </div>
                                                

                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="explanation">Explanation</label>
                                                    <textarea class="form-control" id="explanation{{$j+1}}" name="explanation{{$j+1}}" rows="3"></textarea>
                                                </div>
                                                
                                                
                                                                

                                                    
                                            @endfor


                                            <div class="form-group">
                                                <input type="submit" class="float-right btn btn-primary" value="Save">
                                            </div>
                                        </form>
                                    @else 

                                        <form method="POST" action="{{route('pleasure.store')}}">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <input type="hidden" id="id" name="id" value="{{$utilitarianismSection->id}}">
                                            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
                                            <input type="hidden" id="consequence_id" name="consequence_id" value="{{$consequence->id}}">

                                            @for($j=0; $j<count($stakeholders); $j++)
                                                        
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="stakeholder">Stakeholder {{$j+1}}</label>
                                                    <input type="hidden" id="stakeholde{{$j+1}}r_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                                    <textarea class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" rows="1" readonly>{{$stakeholders[$j]->stakeholder}}</textarea>
                                                </div>

                                                
                                                @for($k=0; $k<count($pleasures); $k++)

                                                
                                                    @if(($pleasures[$k]->consequence_id == $consequence->id) && ($pleasures[$k]->stakeholder_id == $stakeholders[$j]->id)  )
                                                        <div class="row">
                                                            
                                                            <div class="form-group col-md-10">
                                                                <label class="float-left font-weight-bold text-muted" for="pleasure">Pleasure</label> <label class="float-right font-weight-bold text-muted" for="pleasure">Pain</label>
                                                                <input type="range" min="0" max="10" class="form-control-range" id="pleasure{{$k+1}}" name="pleasure{{$k+1}}" value="{{$pleasures[$k]->pleasure}}" required >
                                                                <input type="hidden" id="pleasure{{$k+1}}_id" name="pleasure{{$k+1}}_id"  value="{{$pleasures[$k]->id}}">
                                                            </div>

                                                            @if($pleasures[$k]->level == 'High')
                                                                <div class="form-group col-md-2">
                                                                    <div class="form-check text-justify">
                                                                        <input class="form-check-input" type="radio" name="level{{$k+1}}" id="level{{$k+1}}" value="High" checked required>
                                                                        <label class="form-check-label" for="level">High</label>
                                                                    </div>
                                                                    <div class="form-check text-justify">
                                                                        <input class="form-check-input" type="radio" name="level{{$k+1}}" id="level{{$k+1}}" value="Low">
                                                                        <label class="form-check-label" for="">Low</label>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="form-group col-md-2">
                                                                    <div class="form-check text-justify">
                                                                        <input class="form-check-input" type="radio" name="level{{$k+1}}" id="level{{$k+1}}" value="High" required>
                                                                        <label class="form-check-label" for="level">High</label>
                                                                    </div>
                                                                    <div class="form-check text-justify">
                                                                        <input class="form-check-input" type="radio" name="level{{$k+1}}" id="level{{$k+1}}" value="Low" checked>
                                                                        <label class="form-check-label" for="">Low</label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                                
                                                        </div>
                                                        

                                                        <div class="form-group">
                                                            <label class="font-weight-bold" for="explanation">Explanation</label>
                                                            <textarea class="form-control" id="explanation{{$k+1}}" name="explanation{{$k+1}}" rows="3" required>{{$pleasures[$k]->explanation}}</textarea>
                                                        </div>
                                                    @endif
                                                @endfor
                                                
                                                
                                                                

                                                    
                                            @endfor


                                            <div class="form-group">
                                                <input type="submit" class="float-right btn btn-primary" value="Save">
                                            </div>
                                        </form>
                                    
                                    @endif
                                </div>
                            </div>

                        @endif
                        
                    @endforeach
                    
                @endif
            </div>
        @endfor
        
    </div>

    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">The last thing to consider is the type of pleasures 
            contributing to the greatest happiness. It isn’t just how many 
            stakeholders experience higher pleasures – you have to
            judge how much the higher pleasure should be worth in 
            your final analysis. </p>
    
        @for($i=0; $i<count($options); $i++)
            <div class="card-body">

                <div class="form-group">
                    <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                </div>

                @if(count($options[$i]->consequences)>0 )
                    @foreach($consequences as $consequence)
                        @if(($consequence->option_id == $options[$i]->id))
                            

                            <div class="mb-2 card">
                                <div class="card-header">
                                    Aggregate of {{ucfirst($consequence->type)}}-Term Consequences
                                </div>
                                <div class="card-body">
                                    @if(count($consequence->pleasures)<1)
                                        <form>     
                                                
                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label class="float-left font-weight-bold text-muted" for="pleasure">Pleasure</label> <label class="float-right font-weight-bold text-muted" for="pleasure">Pain</label>
                                                    <input type="range" min="0" max="10" class="form-control-range" id="pleasure" name="pleasure" value="" disabled> 
                                                </div>
                                                
                                                <div class="form-group col-md-2">
                                                    <label for="higher">Higher</label>
                                                    <input type="text" class="form-control" id="higher" value="" disabled>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="lower">Lower</label>
                                                    <input type="text" class="form-control" id="lower" value="" disabled>
                                                </div>
                                                    
                                            </div>

                                        </form>
                                    @else 

                                        <form>     
                                                    
                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label class="float-left font-weight-bold text-muted" for="pleasure">Pleasure</label> <label class="float-right font-weight-bold text-muted" for="pleasure">Pain</label>
                                                    <input type="range" min="0" max="10" class="form-control-range" id="pleasure" name="pleasure" value="{{$pleasures->groupBy('consequence_id')[$consequence->id]->avg('pleasure')}}" disabled> 
                                                </div>
                                                
                                                <div class="form-group col-md-2">
                                                    <label for="higher">Higher</label>
                                                    <input type="text" class="form-control" id="higher" value="{{$pleasures->groupBy('consequence_id')[$consequence->id]->groupBy('level')['High']->count() }}" disabled>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="lower">Lower</label>
                                                    <input type="text" class="form-control" id="lower" value="{{$pleasures->groupBy('consequence_id')[$consequence->id]->groupBy('level')['Low']->count() }}" disabled>
                                                </div>
                                                    
                                            </div>

                                        </form>
                                    
                                    @endif
                                </div>
                            </div>

                        @endif
                        
                    @endforeach
                    
                @endif
            </div>
        @endfor
        
    </div>
    
    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">ETHICAL DECISION/
            COURSE OF ACTION </p>
    
    
        <div class="card-body">

            <form>
                <div class="form-group">
                    <label class="font-weight-bold" for="decision">Decision</label>
                    <textarea class="form-control" id="decision" name="decision" rows="3" placeholder="Sum up your analysis. Eg. Although Option 1 produces pleasures in the short-term, they are lower pleasures. Option 2 results in less overall pain and higher pleasures to the stakeholders most impacted by the issue."></textarea>
                </div>

            </form>
        </div>
       
        
    </div>

</div>

@endsection