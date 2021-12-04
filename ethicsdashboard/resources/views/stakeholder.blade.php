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
        <a class="nav-link active" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">
    <div class="card">
        <h5 class="card-header">Stakeholder Analysis</h5>
        <div class="card-body">
          <p class="card-text">Stakeholders are persons or groups that will be impacted 
            by the decision/action taken.  List the stakeholders and 
            what they want in the simplest terms – wealth, social 
            status, etc.  Note: It’s good to start with the decision-maker 
            as the first stakeholder and then work out from there.</p>

            <form method="POST" action="{{route('stakeholder.store')}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <input type="hidden" id="id" name="id" value="{{$ethicalissue->id}}" >
                <input type="hidden" name="stakeholder_section_id" value="{{$dashboard->stakeholder_section_id}}">

                @for($i=0; $i<6; $i++)
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="stakeholder{{$i+1}}">Stakeholder {{$i+1}}</label>
                            <input type="text" class="form-control" id="stakeholder{{$i+1}}" name="stakeholder{{$i+1}}" @if(count($stakeholders)>0) value="{{$stakeholders[$i]->stakeholder}}" @endif readonly required>
                            <input type="hidden" id="stakeholder{{$i+1}}_id" name="stakeholder{{$i+1}}_id" @if(count($stakeholders)>0) value="{{$stakeholders[$i]->id}}" @endif>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="interest{{$i+1}}">Interests</label>
                            <textarea class="form-control" id="interest{{$i+1}}" name="interest{{$i+1}}" rows="3" readonly required>@if(count($stakeholders)>0) {{$stakeholders[$i]->interests}} @endif </textarea>
                        </div>
                    </div>
                @endfor

                

            </form>
          
        </div>
    </div>

    <div class="mt-3 card">
        <p class="card-header">Instructor Comments & Grade</p>
        <div class="card-body">
            <form method="POST" action="{{route('stakeholdersection.comment',$stakeholderSection->id)}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
        
                <div class="form-group">
                    <label class="font-weight-bold" for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required> {{$stakeholderSection->comment}} </textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="grade">Grade</label>
                    <input type="number" min="0" max="{{$casestudy->stakeholder_points}}" class="form-control col-1" id="grade" name="grade" value="{{$stakeholderSection->grade}}" required>
                    <small id="help" class="form-text text-muted">Out of {{$casestudy->stakeholder_points}} </small>
                </div>

                <input type="submit" class="float-right btn btn-primary" value="Save">

            </form>
          
        </div>
    </div>
</div>

@endsection