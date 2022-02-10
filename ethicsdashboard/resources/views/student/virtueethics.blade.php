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
        <a class="nav-link active" href="{{route('virtuesection.show'), $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="ml-5 mr-5 pl-5 pr-5 mb-2">
        <nav class="nav nav-pills nav-justified">
            <a class="nav-link btn-dark active" href="{{route('virtuesection.show', $dashboard->virtue_section_id)}}">Vices and Virtues</a>
            <a class="nav-link " href="{{route('virtuesection.aggregate', $dashboard->virtue_section_id)}}">Virtue Analysis</a>
            <a class="nav-link " href="{{route('virtuesection.summary', $dashboard->virtue_section_id)}}">Summary</a>
        </nav>
    </div>

    <div class="card border-secondary">
        <p class="card-header font-weight-bold">The Virtuous action is the one that balances the interests of
            the stakeholders in the light of the relavant virtues. 
            Note: This is just a rough approximation of how  Virtue Ethics can be applied to a 
            particular case. Practicing the virtues is a lie-long endeavor - meaning that you
            would evaluate success/failure in consideration of the consequences, re-evaluate
            your decisions and refine your understanding of the virtues until virtuous actions 
            flow from your character.</p>

    <!-- User input of Vices and Virtues for all options-->
        @for($i=0; $i<count($options); $i++)
             <div class="card-body">
                 <form method="POST" action="{{route('virtue.store')}}">
                    {{csrf_field() }}
                    {{method_field('POST')}}
                    <input type="hidden" id="id" name ="id" value="{{$virtueSection->$id}}">

                    <div class="form-group">
                        <label class="font-weight-bold" for="option">Option {{$i+1}}</label>
                        <input type="hidden" id="option_id" name="option_id" @if(isset($options[$i])) value="{{$options[$i]->id}}" @endif>
                        <textarea class="form-control" id="option" name="option" rows="1" readonly>@if(count($options)>0) {{$options[$i]->option}} @endif </textarea>
                    </div>

                     @if(count($options[$i]->virtues)>0)
                        @foreach($virtues as $virtue)
                            @if(($virtue->option_id == $options[$i]->id) && ($virtue->type == "excess"))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="excess">Vice (Excess)</label>
                                    <input type="hidden" id="excess_id" name="excess_id" value="{{$virtue->id}}">
                                    <textarea class="form-control" id="excess" name="excess" rows="3" required>{{$virtue->virtue}}</textarea>
                                </div>

                            @if(($virtue->option_id == $options[$i]->id) && ($virtue->type == "mean"))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="excess">Vice (Excess)</label>
                                    <input type="hidden" id="excess_id" name="excess_id" value="{{$virtue->id}}">
                                    <textarea class="form-control" id="excess" name="excess" rows="3" required>{{$virtue->virtue}}</textarea>
                                </div>
                            @elseif(($virtue->option_id == $options[$i]->id) && ($virtue->type == "deficiency"))
                                <div class="form-group">
                                    <label class="font-weight-bold" for="excess">Vice (Excess)</label>
                                    <input type="hidden" id="excess_id" name="excess_id" value="{{$virtue->id}}">
                                    <textarea class="form-control" id="excess" name="excess" rows="3" required>{{$virtue->virtue}}</textarea>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>
                     @else
                        
                        <div class="form-group">
                            <label class="font-weight-bold" for="excess">Vice (excess)</label>
                            <textarea class="form-control" id="excess" name="excess" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="mean">Virtue (mean)</label>
                            <textarea class="form-control" id="mean" name="mean" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="deficiency">Vice (deficiency)</label>
                            <textarea class="form-control" id="deficiency" name="deficiency" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="float-right btn btn-primary" value="Save">
                        </div>

                    @endif

                </form>
            </div>
        @endfor

        <!-- User input of Vices and Virtues for all stakeholder options-->
    </div>
</div>

@endsection