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
                  <a class="dropdown-item active btn-secondary" href="{{route('deontologysection.moralissue', $dashboard->deontology_section_id)}}">Moral Issue and Moral Laws</a>
                  <a class="dropdown-item" href="{{route('deontologysection.universalizability', $dashboard->deontology_section_id)}}" >Test the Universalizability and Consistency</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('deontologysection.summary', $dashboard->deontology_section_id)}}">Summary</a>
            </li>
        </ul>
    </div>
        
    @for($i=0; $i<count($options); $i++)

        <form method="POST" action="{{route('moralissue.store')}}">
            {{ csrf_field() }}
            {{method_field('POST')}}
            <input type="hidden" id="id" name="id" value="{{$deontologySection->id}}" >
            <input type="hidden" id="option_id" name="option_id" value="{{$options[$i]->id}}">
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

                    <div class="form-group">
                        <input type="hidden" id="moral_issue_id" name="moral_issue_id" @if($options[$i]->moralIssue != null ) value="{{$options[$i]->moralIssue->id}}" @endif>
                        <label for="moralissue">Describe the moral issues governing the decision described in this option.</label>
                        <textarea class="form-control" name="moral_issue" rows="3" required>@if($options[$i]->moralIssue != null ){{$options[$i]->moralIssue->moral_issues}} @endif </textarea>
                    </div>

                    <label for="moralissue">Describe the moral law(s) that govern the actions you will take if you choose this option</label>

                    <div class="form-group">
                        <input type="hidden" name="morallaw1_id" class="form-control" @if(isset($options[$i]->moralLaws[0])) value="{{$options[$i]->moralLaws[0]->id}}" @endif >
                        <div class="form-row">
                            <label for="morallaw1" class="col-form-label">Moral Law 1:</label>
                            <div class="col">
                                <input type="text" name="morallaw1" class="form-control" @if(isset($options[$i]->moralLaws[0])) value="{{$options[$i]->moralLaws[0]->moral_law}}" @endif  required >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="morallaw2_id" class="form-control" @if(isset($options[$i]->moralLaws[1])) value="{{$options[$i]->moralLaws[1]->id}}" @endif >
                        <div class="form-row">
                            <label for="morallaw2" class="col-form-label">Moral Law 2:</label>
                            <div class="col">
                                <input type="text" name="morallaw2" class="form-control" @if(isset($options[$i]->moralLaws[1])) value="{{$options[$i]->moralLaws[1]->moral_law}}" @endif  required >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="morallaw3_id" class="form-control" @if(isset($options[$i]->moralLaws[2])) value="{{$options[$i]->moralLaws[2]->id}}" @endif >
                        <div class="form-row">
                            <label for="morallaw3" class="col-form-label">Moral Law 3:</label>
                            <div class="col">
                                <input type="text" name="morallaw3" class="form-control" @if(isset($options[$i]->moralLaws[2])) value="{{$options[$i]->moralLaws[2]->moral_law}}" @endif  required >
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="float-right btn btn-primary" value="Save">
                    </div>
                </div>

            </div>   
        </form>

        
            
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