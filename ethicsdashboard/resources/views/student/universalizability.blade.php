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
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link active" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="container mb-2">
        <ul class="nav nav-pills nav-justified">
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
                            
                            <div class="form-group">
                                <label class="" for="">TEST IT'S UNIVERSALIZABILITY: Can this law be a universal law of moral action ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->universalizability == 'no')checked @endif @endif value="no">
                                    <label class="form-check-label" for="universalizability">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->universalizability == 'yes')checked @endif @endif  value="yes">
                                    <label class="form-check-label" for="universalizability">Yes</label>
                                </div>  
                                <textarea class="form-control" name="uni_explain" rows="3" required> @if(isset($options[$i]->moralLaws[0])) {{$options[$i]->moralLaws[0]->uni_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If the moral law is not a universal law of moral action - it fails the universalizability test.</small>
                            </div>
    
                            <div class="form-group">
                                <label class="" for="">TEST IT'S CONSISTENCY: Could you live in a world where everyone followed this law ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[0]))  @if($options[$i]->moralLaws[0]->consistency == 'no')checked @endif @endif value="no">
                                    <label class="form-check-label" for="consistency">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[0])) @if($options[$i]->moralLaws[0]->consistency == 'yes')checked @endif @endif value="yes">
                                    <label class="form-check-label" for="consistency">Yes</label>
                                </div>  
                                <textarea class="form-control" name="con_explain" rows="3" required>@if(isset($options[$i]->moralLaws[0])) {{$options[$i]->moralLaws[0]->con_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If universal adherence to this law would be self-defaeatng - it fails the consistency test.</small>
                            </div>
    
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-primary" value="Save">
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
                            
                            <div class="form-group">
                                <label class="" for="">TEST IT'S UNIVERSALIZABILITY: Can this law be a universal law of moral action ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[1]))  @if($options[$i]->moralLaws[1]->universalizability == 'no')checked @endif @endif value="no">
                                    <label class="form-check-label" for="universalizability">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->universalizability == 'yes')checked @endif @endif  value="yes">
                                    <label class="form-check-label" for="universalizability">Yes</label>
                                </div>  
                                <textarea class="form-control" name="uni_explain" rows="3" required>@if(isset($options[$i]->moralLaws[1])) {{$options[$i]->moralLaws[1]->uni_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If the moral law is not a universal law of moral action - it fails the universalizability test.</small>
                            </div>
    
                            <div class="form-group">
                                <label class="" for="">TEST IT'S CONSISTENCY: Could you live in a world where everyone followed this law ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->consistency == 'no')checked @endif @endif  value="no">
                                    <label class="form-check-label" for="consistency">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[1])) @if($options[$i]->moralLaws[1]->consistency == 'yes')checked @endif @endif  value="yes">
                                    <label class="form-check-label" for="consistency">Yes</label>
                                </div>  
                                <textarea class="form-control" name="con_explain" rows="3" required>@if(isset($options[$i]->moralLaws[1])) {{$options[$i]->moralLaws[1]->con_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If universal adherence to this law would be self-defaeatng - it fails the consistency test.</small>
                            </div>
    
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-primary" value="Save">
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
                            
                            <div class="form-group">
                                <label class="" for="">TEST IT'S UNIVERSALIZABILITY: Can this law be a universal law of moral action ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->universalizability == 'no')checked @endif @endif value="no">
                                    <label class="form-check-label" for="universalizability">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="universalizability" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->universalizability == 'yes')checked @endif @endif value="yes">
                                    <label class="form-check-label" for="universalizability">Yes</label>
                                </div>  
                                <textarea class="form-control" name="uni_explain" rows="3" required>@if(isset($options[$i]->moralLaws[2])) {{$options[$i]->moralLaws[2]->uni_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If the moral law is not a universal law of moral action - it fails the universalizability test.</small>
                            </div>
    
                            <div class="form-group">
                                <label class="" for="">TEST IT'S CONSISTENCY: Could you live in a world where everyone followed this law ?</label>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->consistency == 'no')checked @endif @endif  value="no">
                                    <label class="form-check-label" for="consistency">No</label>
                                </div>
                                <div class="form-check form-check-inline float-right">
                                    <input class="form-check-input" type="radio" name="consistency" @if(isset($options[$i]->moralLaws[2])) @if($options[$i]->moralLaws[2]->consistency == 'yes')checked @endif @endif value="yes">
                                    <label class="form-check-label" for="consistency">Yes</label>
                                </div>  
                                <textarea class="form-control" name="con_explain" rows="3" required>@if(isset($options[$i]->moralLaws[2])) {{$options[$i]->moralLaws[2]->con_explain}} @endif </textarea>
                                <small id="helpId" class="text-muted"><b>*</b>If universal adherence to this law would be self-defaeatng - it fails the consistency test.</small>
                            </div>
    
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
    
                        </form>
                    </div>

                
                </div>

            </div>   
        

        
            
    @endfor
    

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