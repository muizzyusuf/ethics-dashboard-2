@extends('layouts.app')

@section('content')
 
<div>
    <a class="mb-2 btn btn-dark" href="{{route('casestudy.show', $dashboard->caseStudy->id)}}">
        ⏴Case Study
    </a> 
</div> 

<div class="container mb-2">
    <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
        <a class="nav-link" href="{{route('dashboard.show', $dashboard->id)}}">Summary</a>
        <a class="nav-link" href="{{route('ethicalissue.show', $dashboard->ethical_issue_id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link active" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="ml-5 mr-5 pl-5 pr-5 mb-2">
        <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
            <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Character</a>
            <a class="nav-link btn-dark active" href="{{route('virtuesection.show', $dashboard->virtue_section_id)}}">Vices and Virtues</a>
            <a class="nav-link " href="{{route('virtuesection.summary', $dashboard->virtue_section_id)}}">Summary</a>
        </nav>
    </div>

    <div class="card border-secondary">
        <p class="card-header font-weight-bold">The Virtuous action is the one that balances the interests of
            the stakeholders in the light of the relavant virtues. 

            Note: This is just a rough approximation of how  Virtue Ethics can be applied to a 
            particular case. Practicing the virtues is a life-long endeavor - meaning that you
            would evaluate success/failure in consideration of the consequences, re-evaluate
            your decisions and refine your understanding of the virtues until virtuous actions 
            flow from your character.</p>
            <div class="card-body">  

                @if(count($dashboard->ethicalIssue->options)<1)

                    <div class="container">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>No option inputs have been made</strong> 
                        </div>
                    </div> 
                      
                @endif
                <!-- User input of Vices and Virtues for all options-->
                @if(count($optionVirtues)<1)
                    <form method="POST" action="{{route('virtue.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        <input type="hidden" id="virtue_section_id" name="virtue_section_id"  value="{{$dashboard->virtue_section_id}}">
                        @for($i=0; $i<count($options); $i++)
                            <div class="container border my-1 py-1 rounded">
                                <div class="form-group row mt-1">
                                    <label class="col-3 col-form-label font-weight-bold" for="option">Option {{$i+1}}:</label>
                                    <input type="hidden" id="option{{$i+1}}_id" name="option{{$i+1}}_id"  value="{{$options[$i]->id}}">
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="option{{$i+1}}" name="option{{$i+1}}" value="{{$options[$i]->option}}" readonly>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2">
                                
                                        <input list="excess"  class="form-control form-control-sm text-center" name="excess{{$i+1}}" placeholder="Vice (Excess)" required>
                                        <datalist id="excess">
                                            <option value="Rashness">
                                            <option value="Extravagant">
                                            <option value="Self-sacrificing">
                                            <option value="Over-ambitious">
                                            <option value="Obsequious">
                                            <option value="Conceited">
                                        </datalist>        
                                                                            
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 offset-lg-3">
                                    
                                        <input list="mean" class="form-control form-control-sm text-center" name="mean{{$i+1}}" placeholder="Virtue (Mean)" required>
                                        <datalist id="mean">
                                            <option value="Courage">
                                            <option value="Generous">
                                            <option value="Benevolent">
                                            <option value="Industrious">
                                            <option value="Friendly">
                                            <option value="Truthful">
                                        </datalist>
                                        
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 offset-lg-3">
                            
                                    
                                        <input list="deficiency" class="form-control form-control-sm text-center" name="deficiency{{$i+1}}" placeholder="Vice (Deficiency)" required>
                                        <datalist id="deficiency">
                                            <option value="Cowardice">
                                            <option value="Stingy">
                                            <option value="Mean">
                                            <option value="Lazy">
                                            <option value="Cantankerous">
                                            <option value="Self-deprecating">
                                        </datalist>
                                            
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <input type="range" min="-9" max="9" class="form-control-range" name="value{{$i+1}}" required >
                                </div>
                            </div>
                        @endfor

                        @if(count($dashboard->ethicalIssue->options)>0)
                            <div class="form-group">
                                <input type="submit" class="float-right btn btn-primary" value="Save">
                            </div>
                        @endif
                    </form>
                @else
                    <form method="POST" action="{{route('virtue.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        
                        <input type="hidden" id="virtue_section_id" name="virtue_section_id"  value="{{$dashboard->virtue_section_id}}">
                        @for($i=0; $i<count($options); $i++)

                            <input type="hidden" id="virtue{{$i+1}}_id" name="virtue{{$i+1}}_id"  value="{{$options[$i]->virtue->id}}">

                            <div class="container border my-1 py-1 rounded">
                                <div class="form-group row mt-1">
                                    <label class="col-3 col-form-label font-weight-bold" for="option">Option {{$i+1}}:</label>
                                    <input type="hidden" id="option{{$i+1}}_id" name="option{{$i+1}}_id"  value="{{$options[$i]->id}}">
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="option{{$i+1}}" name="option{{$i+1}}" value="{{$options[$i]->option}}" readonly>
                                    </div>
                                </div>
                            
        
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2">
                                    
                                        
                                        <input list="excess"  class="form-control form-control-sm text-center" name="excess{{$i+1}}" placeholder="Vice (Excess)" value="{{$options[$i]->virtue->excess}}" required>
                                        <datalist id="excess">
                                            <option value="Rashness">
                                            <option value="Extravagant">
                                            <option value="Self-sacrificing">
                                            <option value="Over-ambitious">
                                            <option value="Obsequious">
                                            <option value="Conceited">
                                        </datalist>
                                            
                                    </div>

                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 offset-lg-3">
                                    
            
                                        <input list="mean" class="form-control form-control-sm text-center" name="mean{{$i+1}}" placeholder="Virtue (Mean)" value="{{$options[$i]->virtue->mean}}" required>
                                        <datalist id="mean">
                                            <option value="Courage">
                                            <option value="Generous">
                                            <option value="Benevolent">
                                            <option value="Industrious">
                                            <option value="Friendly">
                                            <option value="Truthful">
                                        </datalist>

                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 offset-lg-3">
                            
                                    
                                        <input list="deficiency" class="form-control form-control-sm text-center" name="deficiency{{$i+1}}" placeholder="Vice (Deficiency)" value="{{$options[$i]->virtue->deficiency}}" required>
                                        <datalist id="deficiency">
                                            <option value="Cowardice">
                                            <option value="Stingy">
                                            <option value="Mean">
                                            <option value="Lazy">
                                            <option value="Cantankerous">
                                            <option value="Self-deprecating">
                                        </datalist>

                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <input type="range" min="-9" max="9" class="form-control-range" name="value{{$i+1}}" value="{{$options[$i]->virtue->value}}" required >
                                </div>
                            </div>
                        @endfor
                        @if(count($dashboard->ethicalIssue->options)>0)
                            <div class="form-group">
                                <input type="submit" class="float-right btn btn-primary" value="Save">
                            </div>
                        @endif
                    </form>
                @endif
            </div>
    </div>
    <div class="card border-secondary mt-3">
        <p class="card-header font-weight-bold">Consider the context. The virtues are practiced (and understood)
            in the context of a community. Identify the relevant virtues and vices relevant to the stakeholder interests you've tried
        </p>
            <div class="card-body">  

                @if(count($dashboard->stakeholderSection->stakeholders)<1)

                    <div class="container">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>No stakeholder inputs have been made</strong> 
                        </div>
                    </div> 
                      
                @endif
                <!-- User input of Vices and Virtues for all options-->
                @if(count($stakeholderVirtues)<1)
                    <form method="POST" action="{{route('virtue.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        
                        <input type="hidden" id="virtue_section_id" name="virtue_section_id"  value="{{$dashboard->virtue_section_id}}">
                        @for($i=0; $i<count($stakeholders); $i++)
                            <div class="container border my-1 py-1 rounded">
                                <div class="form-group row mt-1">
                                    <label class="col-4 col-md-3 col-form-label font-weight-bold" for="stakeholder">Stakeholders Interest {{$i+1}}:</label>
                                    <input type="hidden" id="stakeholder{{$i+1}}_id" name="stakeholder{{$i+1}}_id"  value="{{$stakeholders[$i]->id}}">
                                    <div class="col-8 col-md-9">
                                        <textarea type="text" class="form-control" id="stakeholder{{$i+1}}" name="stakeholder{{$i+1}}" disabled >{{$stakeholders[$i]->interests}}</textarea>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2">
                                    
                                        
                                        <input list="excess"  class="form-control form-control-sm text-center" name="excess{{$i+1}}" placeholder="Vice (Excess)" required>
                                        <datalist id="excess">
                                            <option value="Rashness">
                                            <option value="Extravagant">
                                            <option value="Self-sacrificing">
                                            <option value="Over-ambitious">
                                            <option value="Obsequious">
                                            <option value="Conceited">
                                        </datalist>
                                        
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 offset-lg-3">
                                    
            
                                        <input list="mean" class="form-control form-control-sm text-center" name="mean{{$i+1}}" placeholder="Virtue (Mean)" required>
                                        <datalist id="mean">
                                            <option value="Courage">
                                            <option vaue="Generous">
                                            <option value="Benevolent">
                                            <option value="Industrious">
                                            <option value="Friendly">
                                            <option value="Truthful">
                                        </datalist>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 offset-lg-3">
                            
                                        <input list="deficiency" class="form-control form-control-sm text-center" name="deficiency{{$i+1}}" placeholder="Vice (Deficiency)" required>
                                        <datalist id="deficiency">
                                            <option value="Cowardice">
                                            <option value="Stingy">
                                            <option value="Mean">
                                            <option value="Lazy">
                                            <option value="Cantankerous">
                                            <option value="Self-deprecating">
                                        </datalist>
                                        
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <input type="range" min="-9" max="9" class="form-control-range" name="value{{$i+1}}" required >
                                </div>
                            </div>
        
                        @endfor
                        @if(count($dashboard->stakeholderSection->stakeholders)>0)
                            <div class="form-group">
                                <input type="submit" class="float-right btn btn-primary" value="Save">
                            </div>
                        @endif
                    </form>
                @else
                    <form method="POST" action="{{route('virtue.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        <input type="hidden" id="virtue_section_id" name="virtue_section_id"  value="{{$dashboard->virtue_section_id}}">
                        @for($i=0; $i<count($stakeholders); $i++)
                            
                            <input type="hidden" id="virtue{{$i+1}}_id" name="virtue{{$i+1}}_id"  value="{{$stakeholders[$i]->virtue->id}}">

                            <div class="container border my-1 py-1 rounded">
                                <div class="form-group row mt-1">
                                    <label class="col-4 col-md-3 col-form-label font-weight-bold" for="stakeholder">Stakeholders Interest {{$i+1}}:</label>
                                    <input type="hidden" id="stakeholder{{$i+1}}_id" name="stakeholder{{$i+1}}_id"  value="{{$stakeholders[$i]->id}}">
                                    <div class="col-8 col-md-9">
                                        <textarea type="text" class="form-control" id="stakeholder{{$i+1}}" name="stakeholder{{$i+1}}" disabled >{{$stakeholders[$i]->interests}}</textarea>
                                    </div>
                                </div>
                            
        
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2">
                                    
                                        
                                        <input list="excess"  class="form-control form-control-sm text-center" name="excess{{$i+1}}" placeholder="Vice (Excess)" value="{{$stakeholders[$i]->virtue->excess}}" required>
                                        <datalist id="excess">
                                            <option value="Rashness">
                                            <option value="Extravagant">
                                            <option value="Self-sacraficing">
                                            <option value="Over-ambitious">
                                            <option value="Obsequious">
                                            <option value="Conceited">
                                        </datalist>

                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 offset-lg-3">
                                    
            
                                        <input list="mean" class="form-control form-control-sm text-center" name="mean{{$i+1}}" placeholder="Virtue (Mean)" value="{{$stakeholders[$i]->virtue->mean}}" required>
                                        <datalist id="mean">
                                            <option value="Courage">
                                            <option value="Generous">
                                            <option value="Benevolent">
                                            <option value="Industrious">
                                            <option value="Friendly">
                                            <option value="Truthful">
                                        </datalist>
                                
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-2 offset-lg-3">
                            
                                    
                                        <input list="deficiency" class="form-control form-control-sm text-center" name="deficiency{{$i+1}}" placeholder="Vice (Deficiency)" value="{{$stakeholders[$i]->virtue->deficiency}}" required>
                                        <datalist id="deficiency">
                                            <option value="Cowardice">
                                            <option value="Stingy">
                                            <option value="Mean">
                                            <option value="Lazy">
                                            <option value="Cantankerous">
                                            <option value="Self-deprecating">
                                        </datalist>
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <input type="range" min="-9" max="9" class="form-control-range" name="value{{$i+1}}" value="{{$stakeholders[$i]->virtue->value}}" required >
                                </div>
                            </div>
                        @endfor
                        @if(count($dashboard->stakeholderSection->stakeholders)>0)
                            <div class="form-group">
                                <input type="submit" class="float-right btn btn-primary" value="Save">
                            </div>
                        @endif
                    </form>
                @endif
            </div>
    </div>
</div>

@endsection
            