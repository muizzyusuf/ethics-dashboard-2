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
        <a class="nav-link active" href="{{route('ethicalissue.show', $ethicalissue->id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">
    <div class="card">
        <p class="card-header font-weight-bold">Decision/Action Under Consideration</p>
        <div class="card-body">
          <p class="card-text">Describe the ethical issue 
            or dilemma you would like 
            to analyze.  Remember, 
            ethical values are things 
            that are important 
            because they are right or 
            wrong – lying, courage, 
            loyalty, theft, etc. </p>

            <form method="POST" action="{{route('ethicalissue.store')}}">
                {{ csrf_field() }}
                {{method_field('POST')}}
                <input type="hidden" id="id" name="id" value="{{$ethicalissue->id}}" >
                <div class="form-group">
                    <label class="font-weight-bold col-form-label" for="issue">Ethical Issue</label>
                    <textarea class="form-control form-control" id="issue" name="issue" rows="3" placeholder="E.g. I am an engineer who is asked to create the VW defeat device. It will make it possible for vehicles to pass emissions tests designed to protect the environment. I'm not sure I should do it because it seems wrong to cheat" required>{{$ethicalissue->issue}} </textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="option1">Option 1</label>
                    <input type="hidden" id="option1_id" name="option1_id" @if(isset($options[0])) value="{{$options[0]->id}}" @endif>
                    <textarea class="form-control" id="option1" name="option1" rows="3" placeholder="E.g. I can put loyalty to the company above my personal concerns and do my job - create the device." required>@if(count($options)>0) {{$options[0]->option}} @endif </textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="option2">Option 2</label>
                    <input type="hidden" id="option2_id" name="option2_id" @if(isset($options[1])) value="{{$options[1]->id}}" @endif>
                    <textarea class="form-control" id="option2" name="option2" rows="3" placeholder="E.g. I can betray the company, go to the press and blow the whistle." required>@if(count($options)>0) {{$options[1]->option}} @endif </textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="option3">Option 3</label>
                    <input type="hidden" id="option3_id" name="option3_id" @if(isset($options[2])) value="{{$options[2]->id}}" @endif>
                    <textarea class="form-control" id="option3" name="option3" rows="3" placeholder="E.g. I can stand up to my superiors, say no and organize colleagues to prevent the cheat device." required>@if(count($options)>0) {{$options[2]->option}} @endif </textarea>
                </div>

              

                <input type="submit" class="float-right btn btn-primary" value="Save">

            </form>
          
        </div>
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