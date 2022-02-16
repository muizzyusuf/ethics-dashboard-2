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

    <div class="card border-secondary">
        <p class="card-header font-weight-bold">A deontological approach to ethical decision making 
            begins with reasoning our way to understanding the 
            moral law that should govern the decision.  Kant called 
            these moral laws categorical (universal, timeless) 
            imperatives (must do’s that are not optional).  To begin, 
            consider the reasons supporting each option. 
        </p>

        @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                
                
                <div class="form-group">
                    <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                    <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                    <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>

                </div>
               
                <form method="POST" action="{{route('motivation.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>

                    <div class="form-group">
                        <label class="font-weight-bold" for="motivation">&nbsp;What is your motivation?</label><br/>
                        <input type="checkbox" name="motivations"id="motivation1{{$i+1}}" name="motivation1{{$i+1}}">&nbsp;Serves your interests <br/>
                        <input type="checkbox" name="motivations"id="motivation2{{$i+1}}" name="motivation2{{$i+1}}">&nbsp;Serves the interests of someone else you want to impress <br/>
                        <input type="checkbox" name="motivations"id="motivation3{{$i+1}}" name="motivation3{{$i+1}}">&nbsp;It will look good <br/>
                        <input type="checkbox" name="motivations"id="motivation4{{$i+1}}" name="motivation4{{$i+1}}">&nbsp;It will pay off in the long run<br/>
                        <input type="checkbox" name="motivations"id="motivation5{{$i+1}}" name="motivation5{{$i+1}}">&nbsp;It costs very little <br/>
                        <input type="checkbox" name="motivations"id="motivation6{{$i+1}}" name="motivation6{{$i+1}}">&nbsp;It’s the right thing to do<br/>
                        <input type="checkbox" name="motivations"id="motivation7{{$i+1}}" name="motivation7{{$i+1}}">&nbsp;Other: <input type ="text" id="motivations" name="motivations" > 
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
                        <label class="font-weight-bold" for="Decision">Decision</label>
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
                <form method="POST" action="{{route('moral_issues.store',$deontologySection->id)}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="moral_issues">Describe the moral issues governing the decision described in Option {{$i+1}}</label><br/>
                        <textarea class="form-control" id="moral_issues" name="moral_issues" rows="2" ></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="float-right btn btn-primary" value="Save">
                    </div>
                </form>
                 
                <form method="POST" action="{{route('morallaw.store')}}">
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