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
            <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Option Analysis</a>
            <a class="nav-link btn-dark active" href="{{route('deontologysection.summary', $dashboard->deontology_section_id)}}">Categorical Imperatives</a>
        </nav>
    </div>

    <div class="card border-secondary">
        <h5 class="card-header font-weight-bold"> Testing Catergorical Imperatives</h5>
        <p class="card-header font-weight-bold">The fundamental principle of our moral duties is a 
            categorical imperative.<br/>
            • It is an imperative because it is a command addressed to agents who could follow it but might not<br/>
            • It is categorical in virtue of applying to us unconditionally – in all times and all places<br/>
            Unlike hypothetical imperatives, categorical imperatives 
            are not relative to a desire or goal </p>

            @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                <form method="POST" action="{{route('morallaw.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="option">Moral Law {{$i+1}}</label>
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                        <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold" for="moralissue">TEST IT’S UNIVERSALIZABILITY</label><br/> 
                        <p>Can you restate the law as a universal law of moral action?
                            <input type ="checkbox" id="universalizability" name="universalizability" > Yes 
                            <input type ="checkbox" id="universalizability" name="universalizability" > No </p>
                        <textarea class="form-control" id="uni_explain" name="uni_explain" rows="2" ></textarea>
                    </div>
                    <p>*If the moral law cannot be expressed as a universal law of 
                        moral action is fails the universalizability test.</p>
                    <div class="form-group">
                        <label class="font-weight-bold" for="moralissue">TEST IT’S CONSISTENCY</label><br/>
                        <p> Could you live in a world where everyone followed this law? 
                             <input type ="checkbox" id="consistency" name="consistency" > Yes 
                            <input type ="checkbox" id="consistency" name="consistency" > No </p>
                        <textarea class="form-control" id="con_explain" name="con_explain" rows="2" ></textarea>
                    </div>
                    <p>*If you could not live in a world where everyone (including you) followed this law, it fails the consistency test.</p>
                    <div class="form-group">
                        <input type="submit" class="float-right btn btn-primary" value="Save">
                    </div>
                
                </form>
            </div>
        @endfor
    </div>

</div>

@endsection