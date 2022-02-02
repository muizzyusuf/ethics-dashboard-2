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
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="container mb-2">
        <nav class="nav nav-pills nav-justified">
            <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Option Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.impact', $dashboard->utilitarianism_section_id)}}">Stakeholder Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.aggregate', $dashboard->utilitarianism_section_id)}}">Pleasure Analysis</a>
            <a class="nav-link  btn-dark active" href="{{route('utilitarianismsection.summary', $dashboard->utilitarianism_section_id)}}">Summary</a>
        </nav>
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
                                                    <input type="text" class="form-control" id="higher" 
                                                    @if(isset($pleasures->groupBy('consequence_id')[$consequence->id]->groupBy('level')['High']))
                                                    value="{{$pleasures->groupBy('consequence_id')[$consequence->id]->groupBy('level')['High']->count() }}"
                                                    @else value="0" @endif disabled>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="lower">Lower</label>
                                                    <input type="text" class="form-control" id="lower" 
                                                    @if(isset($pleasures->groupBy('consequence_id')[$consequence->id]->groupBy('level')['Low']))
                                                    value="{{$pleasures->groupBy('consequence_id')[$consequence->id]->groupBy('level')['Low']->count() }}"
                                                    @else value="0" @endif disabled>
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

            <form method="POST" action="{{route('utilitarianismsection.decision',$utilitarianismSection->id)}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <div class="form-group">
                    <label class="font-weight-bold" for="decision">Decision</label>
                    <textarea class="form-control" id="decision" name="decision" rows="3" placeholder="Sum up your analysis. Eg. Although Option 1 produces pleasures in the short-term, they are lower pleasures. Option 2 results in less overall pain and higher pleasures to the stakeholders most impacted by the issue. Option 2 will produce the greatest happiness and is therefore the right option.">
                        {{$utilitarianismSection->decision}}
                    </textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="float-right btn btn-primary" value="Save">
                </div>
            </form>
        </div>
       
        
    </div>

</div>


@endsection