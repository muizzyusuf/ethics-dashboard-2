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
            <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Option Analysis</a>
            <a class="nav-link btn-dark active" href="{{route('utilitarianismsection.impact', $dashboard->utilitarianism_section_id)}}">Stakeholder Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.aggregate', $dashboard->utilitarianism_section_id)}}">Pleasure Analysis</a>
            <a class="nav-link" href="{{route('utilitarianismsection.summary', $dashboard->utilitarianism_section_id)}}">Summary</a>
        </nav>
    </div>


    <div class="mt-3 card border-secondary">
        <p class="card-header font-weight-bold">Provide reasons why you have included each stakeholder. 
            Make sure to rank them according to the degree of impact (Note: Stakeholder 1 experiences the highest impact)
            Remember! the aim is to defend the inclusion of Stakeholder x and subsequently rank them by degree of impact.
        </p>

        @if(count($stakeholders)<1)
            <div class="card-body">
                <div class="container">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>No stakeholder inputs have been made</strong> 
                    </div>
                </div> 
            </div>  
        @endif
    
        @for($i=0; $i<count($stakeholders); $i++)
            <div class="card-body">
                <div class="container border pt-2 rounded">
                    <form method="POST" action="{{route('impact.store')}}">
                        {{ csrf_field() }}
                        {{method_field('POST')}}
                        <input type="hidden" id="id" name="id" value="{{$utilitarianismSection->id}}" >

                        
                        <div class="form-group">
                            <label class="font-weight-bold" for="stakeholder">Stakeholder {{$i+1}}:</label>
                            <input type="hidden" id="stakeholder_id" name="stakeholder_id" @if(isset($stakeholders[$i])) value="{{$stakeholders[$i]->id}}" @endif>
                            <textarea class="form-control" id="stakeholder" name="stakeholder" rows="1" readonly>@if(count($stakeholders)>0){{$stakeholders[$i]->stakeholder}} @endif </textarea>
                        </div>
                        
                        @if($stakeholders[$i]->impact != null)
                            @foreach($impacts as $impact)
                                @if($impact->stakeholder_id == $stakeholders[$i]->id)
                                <div class="row">
                                    <div class="form-group col-md-11">
                                        <label class="font-weight-bold" for="impact">Impact:</label>
                                        <input type="hidden" id="impact_id" name="impact_id" value="{{$impact->id}}">
                                        <textarea class="form-control" id="impact" name="impact" rows="3" placeholder="E.g The engineer is directly and significantly impacted by the issue. They could lose their job at VW, freinds in industry and suffer career setbacks" required>{{$impact->impact}}</textarea>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label class="font-weight-bold" for="rank">Rank:</label>
                                        <input type="number" class="form-control" id="rank" name="rank" min="1" max="6" value="{{$impact->rank}}" required >
                                        <small id="help" class="form-text text-muted">Out of 6 </small>
                                    </div>
                                </div>
                                    

                                @endif
                                
                            @endforeach
                            <div class="form-group">
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="form-group col-md-11">
                                    <label class="font-weight-bold" for="impact">Impact:</label>
                                    <textarea class="form-control" id="impact" name="impact" rows="3" required></textarea>
                                </div>

                                <div class="form-group col-md-1">
                                    <label class="font-weight-bold" for="rank">Rank:</label>
                                    <input type="number" class="form-control" id="rank" name="rank" min="1" max="6" required >
                                    <small id="help" class="form-text text-muted">Out of 6 </small>
                                </div>
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