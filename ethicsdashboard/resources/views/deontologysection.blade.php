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