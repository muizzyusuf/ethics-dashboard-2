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
        <a class="nav-link" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="container mb-2">
        <nav class="nav nav-pills nav-justified">
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

        @for($i=0; $i<count($options); $i++)
            <div class="card-body">
                <form method="POST" action="{{route('consequence.store')}}">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name="id" value="{{$utilitarianismSection->id}}" >

                    <div class="form-group">
                        <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                        <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>
                    </div>
                    
                    @if(count($options[$i]->consequences)>0 )
                        @foreach($consequences as $consequence)
                            @if(($consequence->option_id == $options[$i]->id) && ($consequence->type == 'short'))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="short">Short Term Consequence</label>
                                    <input type="hidden" id="short_id" name="short_id" value="{{$consequence->id}}">
                                    <textarea class="form-control" id="short" name="short" rows="3" required>{{$consequence->consequence}}</textarea>
                                </div>

                            @elseif(($consequence->option_id == $options[$i]->id) && ($consequence->type == 'long'))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="long">Long Term Consequence</label>
                                    <input type="hidden" id="long_id" name="long_id" value="{{$consequence->id}}">
                                    <textarea class="form-control" id="long" name="long" rows="3" required>{{$consequence->consequence}}</textarea>
                                </div>
                            @endif
                            
                        @endforeach
                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                    @else
                    
                        <div class="form-group">
                            <label class="font-weight-bold" for="short">Short Term Consequence</label>
                            <textarea class="form-control" id="short" name="short" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="long">Long Term Consequence</label>
                            <textarea class="form-control" id="long" name="long" rows="3" required> </textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                
                    @endif
                    

                </form>
            </div>
        @endfor
        
    </div>

</div>

@endsection