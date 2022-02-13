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
        <a class="nav-link active" href="{{route('ethicalissue.show', $ethicalissue->id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.show', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">
    <div class="card">
        <h5 class="card-header">Decision/Action Under Consideration</h5>
        <div class="card-body">
          <p class="card-text">Describe the ethical issue 
            or dilemma you would like 
            to analyze.  Remember, 
            ethical values are things 
            that are important 
            because they are right or 
            wrong – lying, courage, 
            loyalty, theft, etc. </p>

            <form method="POST" action="{{route('ethicalissue.store')}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <input type="hidden" id="id" name="id" value="{{$ethicalissue->id}}" >
                <div class="form-group">
                    <label class="font-weight-bold col-form-label-lg" for="issue">Ethical Issue</label>
                    <textarea class="form-control form-control-lg" id="issue" name="issue" rows="3" readonly required>{{$ethicalissue->issue}} </textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="option1">Option 1</label>
                    <input type="hidden" id="option1_id" name="option1_id" @if(isset($options[0])) value="{{$options[0]->id}}" @endif>
                    <textarea class="form-control" id="option1" name="option1" rows="3" readonly required>@if(count($options)>0) {{$options[0]->option}} @endif </textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="option2">Option 2</label>
                    <input type="hidden" id="option2_id" name="option2_id" @if(isset($options[1])) value="{{$options[1]->id}}" @endif>
                    <textarea class="form-control" id="option2" name="option2" rows="3" readonly required>@if(count($options)>0) {{$options[1]->option}} @endif </textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="option3">Option 3</label>
                    <input type="hidden" id="option3_id" name="option3_id" @if(isset($options[2])) value="{{$options[2]->id}}" @endif>
                    <textarea class="form-control" id="option3" name="option3" rows="3" readonly required>@if(count($options)>0) {{$options[2]->option}} @endif </textarea>
                </div>

              

                

            </form>
          
        </div>
    </div>

    <div class="mt-3 card">
        <p class="card-header">Instructor Comments & Grade</p>
        <div class="card-body">
            <form method="POST" action="{{route('ethicalissue.comment',$ethicalissue->id)}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
        
                <div class="form-group">
                    <label class="font-weight-bold" for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required> {{$ethicalissue->comment}} </textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="grade">Grade</label>
                    <input type="number" min="0" max="{{$casestudy->issue_points}}" class="form-control col-1" id="grade" name="grade" value="{{$ethicalissue->grade}}" required >
                    <small id="help" class="form-text text-muted">Out of {{$casestudy->issue_points}} </small>
                </div>

                <input type="submit" class="float-right btn btn-primary" value="Save">

            </form>
          
        </div>
    </div>
</div>

@endsection