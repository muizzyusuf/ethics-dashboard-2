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
        <a class="nav-link active" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>


<div class="jumbotron">

    <div class="container mb-2">
        <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
            <a class="nav-link btn-dark active" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Option Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.impact', $dashboard->utilitarianism_section_id)}}">Stakeholder Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.aggregate', $dashboard->utilitarianism_section_id)}}">Pleasure Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.summary', $dashboard->utilitarianism_section_id)}}">Summary</a>
        </nav>
    </div>

    <div class="card border-secondary">
        <p class="card-header font-weight-bold">Utilitarianism is a consequentialist theory – meaning that the 
            moral worth of an action is determined by the consequences 
            of the action.  The first step is to consider the consequences, 
            both short-term and long-term, for the options you’ve 
            identified.</p>

        @if(count($options)<1)
            <div class="card-body">
                <div class="container">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>No option inputs have been made</strong> 
                    </div>
                </div> 
            </div>  
        @endif

        @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                <div class="container border pt-2 rounded">
                    <form method="POST" action="{{route('consequence.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        <input type="hidden" id="id" name="id" value="{{$utilitarianismSection->id}}" >

                        <div class="form-group">
                            <label class="font-weight-bold" for="option">Option {{$i+1}}:</label>
                            <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                            <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0){{$options[$i]->option}} @endif </textarea>
                        </div>
                        
                        @if(count($options[$i]->consequences)>0 )
                            @foreach($consequences as $consequence)
                                @if(($consequence->option_id == $options[$i]->id) && ($consequence->type == 'long'))
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="long">Long Term Consequence:</label>
                                        <input type="hidden" id="long_id" name="long_id" value="{{$consequence->id}}">
                                        <textarea class="form-control" id="long" name="long" rows="3" placeholder="E.g. If the device is discovered, it could potentially lead to job loss and/or end of career - VW's reputation will be tarnished" required>{{$consequence->consequence}}</textarea>
                                    </div>
                                @elseif(($consequence->option_id == $options[$i]->id) && ($consequence->type == 'short'))
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="short">Short Term Consequence:</label>
                                        <input type="hidden" id="short_id" name="short_id" value="{{$consequence->id}}">
                                        <textarea class="form-control" id="short" name="short" rows="3" placeholder="E.g. Personal guilt but I keep my job - the consumers are betrayed - the environment is damaged" required>{{$consequence->consequence}}</textarea>
                                    </div>

                                
                                @endif
                                
                            @endforeach
                            <div class="form-group">
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        @else
                        
                            <div class="form-group">
                                <label class="font-weight-bold" for="long">Long Term Consequence:</label>
                                <textarea class="form-control" id="long" name="long" rows="3" required></textarea>
                            </div>
                        
                            <div class="form-group">
                                <label class="font-weight-bold" for="short">Short Term Consequence:</label>
                                <textarea class="form-control" id="short" name="short" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                               
                            </div>
                    
                        @endif
                        

                    </form>
                </div>
            </div>
        @endfor
        
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