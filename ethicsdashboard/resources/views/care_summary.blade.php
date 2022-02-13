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
        <a class="nav-link" href="{{route('virtuesection.show', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link active" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="ml-5 mr-5 pl-5 pr-5 mb-2">
        <nav class="nav nav-pills nav-justified">
            <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Analysis</a>
            <a class="nav-link  btn-dark active" href="{{route('caresection.summary', $dashboard->care_section_id)}}">Summary</a>
        </nav>
    </div>
   
    <div class="container">

        @for($i=0; $i<count($options); $i++)

            <div class="card mb-2">
                <div class="card-header font-weight-bold">
                    Option {{$i+1}}: {{$options[$i]->option}}
                </div>

                @if(count($options[$i]->cares)>0)
                   
                    <div class="card-body">
                        <form method="POST" >
                            <div class="form-group">
                                <label class="label">Duty of Care:</label>
                                                               
                                <input type="range" min="0" max="10" class="form-control-range" value={{ ($options[$i]->cares->avg('attentiveness') + $options[$i]->cares->avg('competence') + $options[$i]->cares->avg('responsiveness'))/3 }} disabled required>
                            
                            </div>
                        </form>
                    </div>
                    
                @else
                    
                        <div class="card-body">
                            <p class="text-center">ANALYSIS NOT DONE</p>
                        </div>
                     
                @endif
            </div> 
                                                            
        @endfor
            
        
    </div>
  
    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">ETHICAL DECISION/
            COURSE OF ACTION </p>
    
    
        <div class="card-body">

            <form method="POST" action="{{route('caresection.decision',$careSection->id)}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <div class="form-group">
                    <label class="font-weight-bold" for="decision">Decision</label>
                    <textarea class="form-control" id="decision" name="decision" rows="3" readonly>{{$careSection->decision}}</textarea>
                </div>

               
            </form>
        </div>
       
        
    </div>

</div>

<div class="mt-3 card">
    <p class="card-header">Instructor Comments & Grade</p>
    <div class="card-body">
        <form method="POST" action="{{route('caresection.comment',$careSection->id)}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
    
            <div class="form-group">
                <label class="font-weight-bold" for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required> {{$careSection->comment}} </textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="grade">Grade</label>
                <input type="number" min="0" max="{{$casestudy->care_points}}" class="form-control col-1" id="grade" name="grade" value="{{$careSection->grade}}" required>
                <small id="help" class="form-text text-muted">Out of {{$casestudy->care_points}} </small>
            </div>

            <input type="submit" class="float-right btn btn-primary" value="Save">

        </form>
      
    </div>
</div>

@endsection