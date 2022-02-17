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
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link active" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="container mb-2">
        <nav class="nav nav-pills nav-justified">
            <a class="nav-link btn-dark active" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Option Analysis</a>
            <a class="nav-link" href="{{route('deontologysection.summary', $dashboard->deontology_section_id)}}">Categorical Imperatives</a>
        </nav>
    </div>

    <div class="card mb-2">
        <div class="card-body">
            <p class="card-subtitle">A deontological approach to ethical decision making 
                begins with reasoning our way to understanding the 
                moral law that should govern the decision.  Kant called 
                these moral laws categorical (universal, timeless) 
                imperatives (must do’s that are not optional).  To begin, 
                consider the reasons supporting each option. </p>
        </div>
    </div>

    
    @for($i=0; $i<count($options); $i++)
        <form method="POST" action="{{route('motivation.store')}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
            <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >
            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
            <div class="card border-secondary mt-2">
                <div class="card-header font-weight-bold">

                    <div class="form-row">
                        <label for="option" class="col-form-label">Option {{$i+1}}:</label>
                        <div class="col">
                          <input type="text" name="option" class="form-control" id="option" value="{{$options[$i]->option}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <h5 class="card-subtitle mb-2 text-muted">What is your motivation?</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Serves your interests" name="motivations[]" >
                        <label class="form-check-label" >
                          Serves your interests
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Serves the interests of someone else you want to impress" name="motivations[]" >
                        <label class="form-check-label" >
                          Serves the interests of someone else you want to impress
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="It will look good" name="motivations[]" >
                        <label class="form-check-label" >
                          It will look good
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="It will pay off in the long run" name="motivations[]" >
                        <label class="form-check-label" >
                          It will pay off in the long run
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Everybody wins" name="motivations[]" >
                        <label class="form-check-label">
                          Everybody wins
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="It costs very little" name="motivations[]" >
                        <label class="form-check-label">
                          It costs very little
                        </label>
                      </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Revenge" name="motivations[]" >
                        <label class="form-check-label">
                            Revenge
                        </label>
                    </div>

                    <div class="form-row">
                        <label class="col-form-label" for="other">Other:</label>
                        <input type="text" class="form-control col-3" name="other" >
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="It's the right thing to do" name="motivations[]">
                        <label class="form-check-label">
                          It's the right thing to do
                        </label>
                    </div>
                    <small id="motivationHelpBlock" class="form-text text-muted">
                        A motivation is either the right thing to do or a combination of the other motivations but should <b>never</b> be both.
                    </small>
                    
                    <div class="form-group">
                        <input type="submit" class="float-right btn btn-primary" value="Save">
                    </div>
                </div>

                @if($options[$i]->imperative != null)

                    <div class="mx-5 text-center alert alert-dark" role="alert">

                        @if($options[$i]->imperative == "categorical")
                            This reasoning is consistent with <b><i>categorical</i></b> reasoning and therefore <b><i>may</i></b> support a moral action
                        @else
                            This reasoning is consistent with <b><i>hypothetical</i></b> reasoning and therefore <b><i>cannot</i></b> support a moral action
                        @endif

                    </div>

                @endif
            </div>   
        </form>

        
            
    @endfor

    <div class="card border-secondary">
        <p class="card-header font-weight-bold">
            
        </p>

        @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                <form method="POST" action="{{route('motivation.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                        <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>
    
                    </div> 
                    <div class="form-group">
                        <label class="font-weight-bold" for="motivation">&nbsp;What is your motivation?</label><br/>
                        <input type="checkbox" id="motivation11" name="motivation11">&nbsp;Serves your interests <br/>
                        <input type="checkbox" id="motivation21" name="motivation21">&nbsp;Serves the interests of someone else you want to impress <br/>
                        <input type="checkbox" id="motivation31" name="motivation31">&nbsp;It will look good <br/>
                        <input type="checkbox" id="motivation41" name="motivation41">&nbsp;It will pay off in the long run<br/>
                        <input type="checkbox" id="motivation51" name="motivation51">&nbsp;It costs very little <br/>
                        <input type="checkbox" id="motivation61" name="motivation61">&nbsp;It’s the right thing to do<br/>
                        &nbsp;Other: <input type ="text" id="motivation71" name="motivation71"> 
                    </div>
                    <div class="form-group">
                        <input type="submit" class="float-right btn btn-primary" value="Save">
                    </div>
                
                </form>
                 
                <form method="POST" action="{{route('deontologysection.decision',$deontologySection->id)}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="Decision">Imperative</label>
                        <p> This reasoning is consistent with 
                        <select name="imperative" id="imperative">
                            <option value="imperative">Hypothetical</option>
                            <option value="impertive">Categorical</option>
                        </select>reasoning. Therefore
                        <select name="decision" id="decision">
                            <option value="cannot">cannot</option>
                            <option value="may">may</option>
                        </select>support a moral action.</p>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="float-right btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        @endfor

        @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                <form method="POST" action="{{route('moral_issues.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                        <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>
    
                    </div> 
                    <div class="form-group">
                        <label class="font-weight-bold" for="moral_issues">Describe the moral issues governing the decision described in Option {{$i+1}}</label><br/>
                        <textarea class="form-control" id="moral_issues" name="moral_issues" rows="2" ></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="float-right btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('morallaw.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >

                    <div class="form-group">
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>    
                    </div>       
                    <div class="form-group">
                        <label class="font-weight-bold" for="moral_law">Define the moral law(s) that govern the actions you will 
                            take if you choose Option {{$i+1}}</label><br/>
                        <textarea class="form-control" id="moral_law1" name="moral_law1" rows="1" ></textarea>
                        <textarea class="form-control" id="moral_law2" name="moral_law2" rows="1" ></textarea>
                        <textarea class="form-control" id="moral_law3" name="moral_law3" rows="1" ></textarea>

                    </div>

                    <div class="form-group">
                        <input type="submit" class="float-right btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        @endfor

    
    </div>

</div>

@endsection