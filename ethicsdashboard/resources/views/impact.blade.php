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

    <div class="container mb-2">
        <nav class="nav nav-pills nav-justified">
            <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Option Analysis</a>
            <a class="nav-link btn-dark active" href="{{route('utilitarianismsection.impact', $dashboard->utilitarianism_section_id)}}">Stakeholder Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.aggregate', $dashboard->utilitarianism_section_id)}}">Pleasure Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.summary', $dashboard->utilitarianism_section_id)}}">Summary</a>
        </nav>
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
                                    <textarea class="form-control" id="impact" name="impact" rows="3" readonly required>{{$impact->impact}}</textarea>
                                </div>

                                <div class="form-group col-md-1">
                                    <label class="font-weight-bold" for="rank">Rank</label>
                                    <input type="number" class="form-control" id="rank" name="rank" min="1" max="6" value="{{$impact->rank}}" readonly required >
                                </div>
                            </div>
                                

                            @endif
                            
                        @endforeach
                        
                    @else
                        <div class="row">
                            <div class="form-group col-md-11">
                                <label class="font-weight-bold" for="impact">Impact</label>
                                <textarea class="form-control" id="impact" name="impact" rows="3" readonly required></textarea>
                            </div>

                            <div class="form-group col-md-1">
                                <label class="font-weight-bold" for="rank">Rank</label>
                                <input type="number" class="form-control" id="rank" name="rank" min="1" max="6" readonly required >
                            </div>
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
        <form method="POST" action="{{route('utilitarianismsection.comment',$utilitarianismSection->id)}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
    
            <div class="form-group">
                <label class="font-weight-bold" for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required> {{$utilitarianismSection->comment}} </textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="grade">Grade</label>
                <input type="number" min="0" max="{{$casestudy->util_points}}" class="form-control col-1" id="grade" name="grade" value="{{$utilitarianismSection->grade}}" required>
                <small id="help" class="form-text text-muted">Out of {{$casestudy->util_points}} </small>
            </div>

            <input type="submit" class="float-right btn btn-primary" value="Save">

        </form>
      
    </div>
</div>
@endsection