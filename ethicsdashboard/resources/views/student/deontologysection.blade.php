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
        <a class="nav-link active" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="container mb-2">
        <nav class="nav nav-pills nav-justified">
            <a class="nav-link btn-dark active" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Option Analysis</a>
            <a class="nav-link" href="{{route('deontologysection.summary', $dashboard->deontology_section_id)}}">Summary</a>
        </nav>
    </div>

    <div class="card border-secondary">
        <p class="card-header font-weight-bold">A deontological approach to ethical decision making 
            begins with reasoning our way to understanding the 
            moral law that should govern the decision.  Kant called 
            these moral laws categorical (universal, timeless) 
            imperatives (must do’s that are not optional).  To begin, 
            consider the reasons supporting each option. </p>

            @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                <form method="POST" action="{{route('consequence.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                        <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>
                    </div>
                    
                    @if(count($options[$i]->consequences)>0 )
                        @foreach($consequences as $consequence)
                            @if(($consequence->option_id == $options[$i]->id) && ($consequence->type == 'short'))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="short">Motivation</label>
                                    <input type="hidden" id="short_id" name="short_id" value="{{$consequence->id}}">
                                    <input type="checkbox" name="fruits[]" value="Mango">Serves your interests <br/>
                                </div>

                            @elseif(($consequence->option_id == $options[$i]->id) && ($consequence->type == 'long'))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="long">Decision</label>
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
                            <label class="font-weight-bold" for="motivation">What is your motivation?</label><br/>
                            <input type="checkbox" name="motivations">Serves your interests <br/>
                            <input type="checkbox" name="motivations">Serves the interests of someone else you want to impress <br/>
                            <input type="checkbox" name="motivations">It will look good <br/>
                            <input type="checkbox" name="motivations">It will pay off in the long run<br/>
                            <input type="checkbox" name="motivations">It costs very little <br/>
                            <input type="checkbox" name="motivations">It’s the right thing to do<br/>
                            <input type="checkbox" name="motivations">Other:
                            <textarea class="form-control" id="short" name="short" rows="1"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="Decision">Decision</label>
                            <p> This reasoning is consistent with 
                            <select name="imperatives" id="imperatives">
                                <option value="Hypothetical">Hypothetical</option>
                                <option value="Categorical">Categorical</option>
                            </select>reasoning.Therefore
                            <select name="decision" id="decision">
                                <option value="....">cannot</option>
                                <option value="may">may</option>
                            </select>support a moral action.</p>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                
                    @endif
                    

                </form>
            </div>
        @endfor
    </div>

</div>

<div class="mt-3 card">
    <p class="card-header">Instructor Comments & Grade</p>
    <div class="card-body">
        <form method="POST" action="{{route('deontologysection.comment', $deontologySection->id)}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
    
            <div class="form-group">
                <label class="font-weight-bold" for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required> {{$deontologySection->comment}} </textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="grade">Grade</label>
                <input type="number" min="0" max="{{$casestudy->deontology_points}}" class="form-control col-1" id="grade" name="grade" value="{{$deontologySection->grade}}" required>
                <small id="help" class="form-text text-muted">Out of {{$casestudy->deontology_points}} </small>
            </div>

            <input type="submit" class="float-right btn btn-primary" value="Save">

        </form>
      
    </div>
</div>
@endsection