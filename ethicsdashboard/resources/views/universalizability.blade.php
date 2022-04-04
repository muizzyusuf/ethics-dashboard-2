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
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link active" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="container mb-2">
        <ul class="nav nav-pills nav-justified flex-column flex-lg-row">
            <li class="nav-item">
                <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Option Analysis</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link active btn-dark dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Testing Categorical Imperatives</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('deontologysection.moralissue', $dashboard->deontology_section_id)}}">Moral Issue and Moral Laws</a>
                  <a class="dropdown-item active btn-secondary" href="{{route('deontologysection.universalizability', $dashboard->deontology_section_id)}}">Test the Universalizability and Consistency</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('deontologysection.summary', $dashboard->deontology_section_id)}}">Summary</a>
            </li>
        </ul>
    </div>


    @if(count($options)<1)

        <div class="container">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>There are no options with a reasoning that is consistent with categorical reasoning</strong> 
            </div>
        </div> 
                              
    @endif 
        
    @for($i=0; $i<count($options); $i++)

            <div class="card border-secondary mt-2">
                <div class="card-header font-weight-bold">
 
                    <div class="form-row">
                        <label for="option" class="col-form-label">Option :</label>
                        <div class="col">
                            <input type="text" name="option" class="form-control" id="option" value="{{$options[$i]->option}}" readonly>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">

                    @if(count($options[$i]->moralLaws)<1)

                        <div class="container">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>You have not input the moral laws for this option</strong> 
                            </div>
                        </div> 
                 
                    @endif 

                    <div class="container border my-2 py-1 rounded">
                        <form method="POST" action="{{route('morallaw.store')}}">
                            {{ csrf_field() }}
                            {{method_field('POST')}}
                            <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >
                            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
    
                            <div class="form-group mt-2">
                                <input type="hidden" name="morallaw_id" class="form-control" @if(isset($options[$i]->moralLaws[0])) value="{{$options[$i]->moralLaws[0]->id}}" @endif >
                                <div class="form-row">
                                    <label for="morallaw" class="col-form-label">Moral Law:</label>
                                    <div class="col">
                                        <input type="text" name="morallaw" class="form-control" @if(isset($options[$i]->moralLaws[0])) value="{{$options[$i]->moralLaws[0]->moral_law}}" @endif  readonly>
                                    </div>
                                </div>
                            </div>

                            @if(isset($options[$i]->moralLaws[0]))
                                @if($options[$i]->moralLaws[0]->universalizability==null)
                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>You have not tested the universalizability and consistency of this moral law</strong> 
                                        </div>
                                    </div>
                                @endif
                            @endif 
                            
                            <div class="form-group">
                                <label class="" for="">TEST IT'S UNIVERSALIZABILITY: Can this law be a universal law of moral action ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->universalizability == 'no')checked @endif @endif value="no" disabled>
                                    <label class="form-check-label" for="universalizability">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->universalizability == 'yes')checked @endif @endif  value="yes" disabled>
                                    <label class="form-check-label" for="universalizability">Yes</label>
                                </div>  
                                <textarea class="form-control" name="uni_explain" rows="3" disabled> @if(isset($options[$i]->moralLaws[0])) {{$options[$i]->moralLaws[0]->uni_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If the moral law is not a universal law of moral action - it fails the universalizability test.</small>
                            </div>
    
                            <div class="form-group">
                                <label class="" for="">TEST IT'S CONSISTENCY: Could you live in a world where everyone followed this law ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[0]))  @if($options[$i]->moralLaws[0]->consistency == 'no')checked @endif @endif value="no" disabled>
                                    <label class="form-check-label" for="consistency">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->consistency == 'yes')checked @endif @endif value="yes" disabled>
                                    <label class="form-check-label" for="consistency">Yes</label>
                                </div>  
                                <textarea class="form-control" name="con_explain" rows="3" disabled>@if(isset($options[$i]->moralLaws[0])) {{$options[$i]->moralLaws[0]->con_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If universal adherence to this law would be self-defaeatng - it fails the consistency test.</small>
                            </div>
    
                        </form>
                    </div>

                    <div class="container border my-2 py-1 rounded">
                        <form method="POST" action="{{route('morallaw.store')}}">
                            {{ csrf_field() }}
                            {{method_field('POST')}}
                            <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >
                            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
    
                            <div class="form-group mt-2">
                                <input type="hidden" name="morallaw_id" class="form-control"  @if(isset($options[$i]->moralLaws[1])) value="{{$options[$i]->moralLaws[1]->id}}" @endif >
                                <div class="form-row">
                                    <label for="morallaw" class="col-form-label">Moral Law:</label>
                                    <div class="col">
                                        <input type="text" name="morallaw" class="form-control" @if(isset($options[$i]->moralLaws[1])) value="{{$options[$i]->moralLaws[1]->moral_law}}" @endif  readonly>
                                    </div>
                                </div>
                            </div>

                            @if(isset($options[$i]->moralLaws[1]))
                                @if($options[$i]->moralLaws[1]->universalizability==null)
                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>You have not tested the universalizability and consistency of this moral law</strong> 
                                        </div>
                                    </div>
                                @endif
                            @endif 
                            
                            <div class="form-group">
                                <label class="" for="">TEST IT'S UNIVERSALIZABILITY: Can this law be a universal law of moral action ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[1]))  @if($options[$i]->moralLaws[1]->universalizability == 'no')checked @endif @endif value="no" disabled>
                                    <label class="form-check-label" for="universalizability">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->universalizability == 'yes')checked @endif @endif  value="yes" disabled>
                                    <label class="form-check-label" for="universalizability">Yes</label>
                                </div>  
                                <textarea class="form-control" name="uni_explain" rows="3" disabled >@if(isset($options[$i]->moralLaws[1])) {{$options[$i]->moralLaws[1]->uni_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If the moral law is not a universal law of moral action - it fails the universalizability test.</small>
                            </div>
    
                            <div class="form-group">
                                <label class="" for="">TEST IT'S CONSISTENCY: Could you live in a world where everyone followed this law ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->consistency == 'no')checked @endif @endif  value="no" disabled>
                                    <label class="form-check-label" for="consistency">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->consistency == 'yes')checked @endif @endif  value="yes" disabled>
                                    <label class="form-check-label" for="consistency">Yes</label>
                                </div>  
                                <textarea class="form-control" name="con_explain" rows="3" disabled >@if(isset($options[$i]->moralLaws[1])) {{$options[$i]->moralLaws[1]->con_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If universal adherence to this law would be self-defaeatng - it fails the consistency test.</small>
                            </div>
    
                        </form>
                    </div>

                    <div class="container border my-2 py-1 rounded">
                        <form method="POST" action="{{route('morallaw.store')}}">
                            {{ csrf_field() }}
                            {{method_field('POST')}}
                            <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >
                            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
    
                            <div class="form-group mt-2">
                                <input type="hidden" name="morallaw_id" class="form-control" @if(isset($options[$i]->moralLaws[2])) value="{{$options[$i]->moralLaws[2]->id}}" @endif >
                                <div class="form-row">
                                    <label for="morallaw" class="col-form-label">Moral Law:</label>
                                    <div class="col">
                                        <input type="text" name="morallaw" class="form-control" @if(isset($options[$i]->moralLaws[2])) value="{{$options[$i]->moralLaws[2]->moral_law}}" @endif  readonly >
                                    </div>
                                </div>
                            </div>

                            @if(isset($options[$i]->moralLaws[2]))
                                @if($options[$i]->moralLaws[2]->universalizability==null)
                                    <div class="container">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>You have not tested the universalizability and consistency of this moral law</strong> 
                                        </div>
                                    </div>
                                @endif
                            @endif 
                            
                            <div class="form-group">
                                <label class="" for="">TEST IT'S UNIVERSALIZABILITY: Can this law be a universal law of moral action ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->universalizability == 'no')checked @endif @endif value="no" disabled>
                                    <label class="form-check-label" for="universalizability">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->universalizability == 'yes')checked @endif @endif value="yes" disabled>
                                    <label class="form-check-label" for="universalizability">Yes</label>
                                </div>  
                                <textarea class="form-control" name="uni_explain" rows="3" disabled >@if(isset($options[$i]->moralLaws[2])) {{$options[$i]->moralLaws[2]->uni_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If the moral law is not a universal law of moral action - it fails the universalizability test.</small>
                            </div>
    
                            <div class="form-group">
                                <label class="" for="">TEST IT'S CONSISTENCY: Could you live in a world where everyone followed this law ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->consistency == 'no')checked @endif @endif  value="no" disabled>
                                    <label class="form-check-label" for="consistency">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->consistency == 'yes')checked @endif @endif value="yes" disabled>
                                    <label class="form-check-label" for="consistency">Yes</label>
                                </div>  
                                <textarea class="form-control" name="con_explain" rows="3" disabled >@if(isset($options[$i]->moralLaws[2])) {{$options[$i]->moralLaws[2]->con_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If universal adherence to this law would be self-defaeatng - it fails the consistency test.</small>
                            </div>
    
                        </form>
                    </div>

                
                </div>

            </div>   
        

        
            
    @endfor
    

</div>

<div class="mt-3 card">
    <p class="card-header">Instructor Comments & Grade</p>
    <div class="card-body">
        <form method="POST" action="{{route('deontologysection.comment', $deontologySection->id)}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
    
            <div class="form-group row">
                <label class="font-weight-bold col-form-label col-3" for="comment">Comment:</label>
                <div class="col-9">
                    <textarea class="form-control" id="comment" name="comment" rows="3" required>{{$deontologySection->comment}}</textarea>
                </div>
                
            </div>

            <div class="form-group row">
                <label class="font-weight-bold col-form-label col-3" for="grade">Grade:</label>
                <div class="col-9">
                    <input type="number" min="0" max="{{$dashboard->caseStudy->deontology_points}}" class="form-control" id="grade" name="grade" value="{{$deontologySection->grade}}" required >
                    <small id="help" class="form-text text-muted">Out of {{$dashboard->caseStudy->deontology_points}} </small>
                </div>
                
            </div>

            <input type="submit" class="float-right btn btn-primary" value="Save">

        </form>
      
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
  
      $("form").submit(function () {
        // prevent duplicate form submissions
        $(this).find(":submit").attr('disabled', 'disabled');
        $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  
      });
    });
  </script>

@endsection