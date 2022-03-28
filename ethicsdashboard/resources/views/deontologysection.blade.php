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
                <a class="nav-link btn-dark active" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Option Analysis</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Testing Categorical Imperatives</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('deontologysection.moralissue', $dashboard->deontology_section_id)}}">Moral Issue and Moral Laws</a>
                  <a class="dropdown-item" href="{{route('deontologysection.universalizability', $dashboard->deontology_section_id)}}" >Test the Universalizability and Consistency</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('deontologysection.summary', $dashboard->deontology_section_id)}}">Summary</a>
            </li>
        </ul>
    </div>

    



    <div class="card mb-2">
        <div class="card-body">
            <p class="card-subtitle">A deontological approach to ethical decision making 
                begins with reasoning our way to understanding the 
                moral law that should govern the decision.  Kant called 
                these moral laws categorical (universal, timeless) 
                imperatives (must do’s that are not optional).  To begin, 
                consider the reasons supporting each option. </p>
        </div>
    </div>

    
    @for($i=0; $i<count($options); $i++)

        <form method="POST" action="{{route('motivation.store')}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
            <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >
            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
            <div class="card border-secondary mt-2">
                <div class="card-header font-weight-bold">

                    <div class="form-row">
                        <label for="option" class="col-form-label">Option {{$i+1}}:</label>
                        <div class="col">
                          <input type="text" name="option" class="form-control" id="option" value="{{$options[$i]->option}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <h5 class="card-subtitle mb-2 text-muted">What is your motivation ?</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Serves your interests" @if($options[$i]->motivations->contains('motivation','Serves your interests'))checked @endif name="motivations[]" disabled >
                        <label class="form-check-label" >
                          Serves your interests
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Serves the interests of someone else you want to impress" @if($options[$i]->motivations->contains('motivation','Serves the interests of someone else you want to impress'))checked @endif name="motivations[]" disabled >
                        <label class="form-check-label" >
                          Serves the interests of someone else you want to impress
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="It will look good" @if($options[$i]->motivations->contains('motivation','It will look good'))checked @endif name="motivations[]" disabled >
                        <label class="form-check-label" >
                          It will look good
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="It will pay off in the long run" @if($options[$i]->motivations->contains('motivation','It will pay off in the long run'))checked @endif name="motivations[]" disabled >
                        <label class="form-check-label" >
                          It will pay off in the long run
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Everybody wins" @if($options[$i]->motivations->contains('motivation','Everybody wins'))checked @endif name="motivations[]" disabled >
                        <label class="form-check-label">
                          Everybody wins
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="It costs very little" @if($options[$i]->motivations->contains('motivation','It costs very little'))checked @endif name="motivations[]" disabled >
                        <label class="form-check-label">
                          It costs very little
                        </label>
                      </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Revenge" @if($options[$i]->motivations->contains('motivation','Revenge'))checked @endif name="motivations[]" disabled>
                        <label class="form-check-label">
                            Revenge
                        </label>
                    </div>

                    <div class="form-row">
                        <label class="col-form-label" for="other">Other:</label>
                        <input type="text" class="form-control col-3" name="other" @if($options[$i]->motivations->contains('other','Yes')) value="{{$options[$i]->motivations->firstWhere('other','Yes')->motivation}}" @endif readonly >
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="It's the right thing to do" @if($options[$i]->motivations->contains('motivation',"It's the right thing to do"))checked @endif name="motivations[]" disabled>
                        <label class="form-check-label">
                          It's the right thing to do
                        </label>
                    </div>
                    <small id="motivationHelpBlock" class="form-text text-muted">
                        A motivation is either the right thing to do or a combination of the other motivations but should <b>never</b> be both.
                    </small>
    
                </div>

                @if($options[$i]->imperative != null)

                    <div class="mx-5 text-center alert alert-dark" role="alert">

                        @if($options[$i]->imperative == "categorical")
                            This reasoning is consistent with <b><i>categorical</i></b> reasoning and therefore <b><i>may</i></b> support a moral action
                        @else
                            This reasoning is consistent with <b><i>hypothetical</i></b> reasoning and therefore <b><i>cannot</i></b> support a moral action
                        @endif

                    </div>

                @endif
            </div>   
        </form>

        
            
    @endfor



</div>

<div class="mt-3 card">
    <p class="card-header">Instructor Comments & Grade</p>
    <div class="card-body">
        <form method="POST" action="{{route('deontologysection.comment',$deontologySection->id)}}">
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