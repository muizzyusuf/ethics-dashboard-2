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
        <a class="nav-link active" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">


    <div class="card border-secondary">

        <div class="card-header font-weight-bold">Care ethics we come to understand the right thing to do by considering how we can care for others.  There are three main features of care that we can use to quantify this:
            <ol>
                <li>Attentiveness: Being aware of needs in others. </li>
                <li>Competence: The ability to deliver what is needed.</li>
                <li>Responsiveness: Empathy for the position of others in need of care.</li>
            </ol>    
        
        </div>

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
                    
                    <div class="card-body">
                                    @if(count($cares)<1)
                                        <form method="POST" action="{{route('care.store')}}">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <input type="hidden" id="id" name="id" value="{{$careSection->id}}">
                                            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
                                            
                                            @for($j=0; $j<count($stakeholders); $j++)
                                                        
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="stakeholder">Stakeholder {{$j+1}}</label>
                                                    <input type="hidden" id="stakeholder{{$j+1}}_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                                    <textarea class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" rows="1" readonly>{{$stakeholders[$j]->stakeholder}}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-10">
                                                        <div><label>Attentiveness:</label></div>
                                                        <label class="float-left font-weight-bold text-muted" for="attentiveness">Low</label> <label class="float-right font-weight-bold text-muted" for="attentiveness">High</label>
                                                        <input type="range" min="0" max="10" class="form-control-range" id="attentiveness{{$j+1}}" name="attentiveness{{$j+1}}" required>
                                                        
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                    <div><label>Competence:</label></div>
                                                        <label class="float-left font-weight-bold text-muted" for="competence">Low</label> <label class="float-right font-weight-bold text-muted" for="competence">High</label>
                                                        <input type="range" min="0" max="10" class="form-control-range" id="competence{{$j+1}}" name="competence{{$j+1}}" required>
                                                        
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                    <div><label>Responsiveness:</label></div>
                                                        <label class="float-left font-weight-bold text-muted" for="responsiveness">Low</label> <label class="float-right font-weight-bold text-muted" for="responsiveness">High</label>
                                                        <input type="range" min="0" max="10" class="form-control-range" id="responsiveness{{$j+1}}" name="responsiveness{{$j+1}}" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            
                        
                                                
                                                                

                                                    
                                                @endfor

                            
                        <div class="form-group">
            <input type="submit" class="float-right btn btn-primary" value="Save">
        </div>
        </form>
                        
                    </div>
                          <!--Display Summary of Attentiveness, Competence, Responsiveness for each Stakeholder in each Option-->
                            
    
                    
                    @else
                    <form method="POST" action="{{route('care.store')}}">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <input type="hidden" id="id" name="id" value="{{$careSection->id}}">
                                            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
                                           
                                            @for($j=0; $j<count($stakeholders); $j++)
                                                        
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="stakeholder">Stakeholder {{$j+1}}</label>
                                                    <input type="hidden" id="stakeholde{{$j+1}}r_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                                    <textarea class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" rows="1" readonly>{{$stakeholders[$j]->stakeholder}}</textarea>
                                                </div>

                                                
                                                @for($k=0; $k<count($cares); $k++)

                                                
                                                    @if(($cares[$k]->stakeholder_id == $stakeholders[$j]->id && $cares[$k]->option_id == $options[$i]->id)  )
                                                        <div class="row">
                                                            
                                                            <div class="form-group col-md-10">
                                                                <div><label>Attentiveness:</label></div>
                                                                <label class="float-left font-weight-bold text-muted" for="attentiveness">Low</label> <label class="float-right font-weight-bold text-muted" for="attentiveness">High</label>
                                                                <input type="range" min="0" max="10" class="form-control-range" id="attentiveness{{$k+1}}" name="attentiveness{{$k+1}}" value="{{$cares[$k]->attentiveness}}" required >
                                                                <div><label>Competence:</label></div>
                                                                <label class="float-left font-weight-bold text-muted" for="competence">Low</label> <label class="float-right font-weight-bold text-muted" for="competence">High</label>
                                                                <input type="range" min="0" max="10" class="form-control-range" id="competence{{$k+1}}" name="competence{{$k+1}}" value="{{$cares[$k]->competence}}" required >
                                                                <div><label>Responsiveness:</label></div>
                                                                <label class="float-left font-weight-bold text-muted" for="responsiveness">Low</label> <label class="float-right font-weight-bold text-muted" for="responsiveness">High</label>
                                                                <input type="range" min="0" max="10" class="form-control-range" id="responsiveness{{$k+1}}" name="responsiveness{{$k+1}}" value="{{$cares[$k]->responsiveness}}" required >
                                                                <input type="hidden" id="care{{$k+1}}_id" name="care{{$k+1}}_id"  value="{{$cares[$k]->id}}">
                                                            </div>

                                        </div>
                                        
                                                        @else

                                                        <div class="form-group">
                                                    <label class="font-weight-bold" for="stakeholder">Stakeholder {{$j+1}}</label>
                                                    <input type="hidden" id="stakeholder{{$j+1}}_id" name="stakeholder{{$j+1}}_id"  value="{{$stakeholders[$j]->id}}">
                                                    <textarea class="form-control" id="stakeholder{{$j+1}}" name="stakeholder{{$j+1}}" rows="1" readonly>{{$stakeholders[$j]->stakeholder}}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-10">
                                                        <div><label>Attentiveness:</label></div>
                                                        <label class="float-left font-weight-bold text-muted" for="attentiveness">Low</label> <label class="float-right font-weight-bold text-muted" for="attentiveness">High</label>
                                                        <input type="range" min="0" max="10" class="form-control-range" id="attentiveness{{$j+1}}" name="attentiveness{{$j+1}}" required>
                                                        
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                    <div><label>Competence:</label></div>
                                                        <label class="float-left font-weight-bold text-muted" for="competence">Low</label> <label class="float-right font-weight-bold text-muted" for="competence">High</label>
                                                        <input type="range" min="0" max="10" class="form-control-range" id="competence{{$j+1}}" name="competence{{$j+1}}" required>
                                                        
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                    <div><label>Responsiveness:</label></div>
                                                        <label class="float-left font-weight-bold text-muted" for="responsiveness">Low</label> <label class="float-right font-weight-bold text-muted" for="responsiveness">High</label>
                                                        <input type="range" min="0" max="10" class="form-control-range" id="responsiveness{{$j+1}}" name="responsiveness{{$j+1}}" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            
                                        @endif
                                        @endfor
                                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>     
                        </form>
                                        @endfor
                                        @endif                      

                                                                  
                 @endfor
             
            
                 </div>
    </div>

</div>

@endsection