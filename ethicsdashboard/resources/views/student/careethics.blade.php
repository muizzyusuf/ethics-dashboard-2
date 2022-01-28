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
        <a class="nav-link" href="{{route('caresection.show', $dashboard->utilitarianism_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">


    <div class="card border-secondary">
        <p class="card-header font-weight-bold">Care ethics we come to understand the right thing to do by considering how we can care for others.  There are three main features of care that we can use to quantify this:</p>
            <p class="card-header font-weight-bold"> 1) Attentiveness: Being aware of needs in others.</p>  
             <p class="card-header font-weight-bold">2) Competence: The ability to deliver what is needed.</p>
             <p class="card-header font-weight-bold">3) Responsiveness: Empathy for the position of others in need of care.</p>

        @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                <form method="POST" action="{{route('care.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$careSection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                        <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>
                    </div>
                    
                    @if(count($options[$i]->cares)>0 )
                        @foreach($cares as $care)
                          <!--Display Summary of Attentiveness, Competence, Responsiveness for each Stakeholder in each Option-->
                            
                        @endforeach
                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                    @else
                    @for($j=0; $j<count($stakeholders); $j++)
            
                        <div class="form-group">
                            <label class="font-weight-bold">Stakeholder {{$stakeholders[$j]->id}}</label>
                            <input type="hidden" id="stakeholder_id" name="stakeholder_id"  value="{{$stakeholders[$j]->id}}" >
                            <p>Attentiveness:</p>
                            <div>
                            <input type="range" min="0" max="10" class="form-control-range" id="attentiveness{{$j}}" name="attentivenss{{$j}}" required>   
                        </div>
                            <p>Competence:</p>
                            <div>
                            <input type="range" min="0" max="10" class="form-control-range" id="competence{{$j}}" name="competence{{$j}}" required>
                            </div>  
                            <p>Responsiveness:</p>
                            <div>
                            <input type="range" min="0" max="10" class="form-control-range" id="responsiveness{{$j}}" name="responsiveness{{$j}}" required>                        
                            </div>
                        </div>

                  
                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                       
                        <label></label>
                    @endfor
                    
                    @endif
                    

                </form>
            </div>
        @endfor
        
    </div>

</div>

@endsection