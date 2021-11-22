@extends('layouts.app')

@section('content')

<!-- {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="container">
                    <div class="card-header">
                        <h1>{{$dashboard->name}} Home</h1>

                    </div>

                    <div class="card-body">

                        <h3><u> Ethical Issue:</u></h3>
                        @if (empty($ethicalissue->issue))
                        <div>

                            <form method="GET" action="{{ route('ethicalissues', $dashboard->id) }}">

                                <button type="submit" class="btn btn-danger">Create Ethical Issue</button>
                            </form>
                        </div>


                        @else

                        <p> {{$ethicalissue->issue}}</p>



                        @endif
                        <hr>
                        </hr>
                        <h3><u> Stakeholders:</u></h3>
                        @if (empty($stakeholders[0]->id))
                        <div>
                            <form method="GET" action="{{ route('stakeholders', $dashboard->id) }}">

                                <button type="submit" class="btn btn-danger">Create Stakeholders</button>
                            </form>
                        </div>


                        @else

                        <table class="table table-bordered">
                            <th width="25%"></th>
                            <th>Stakeholder Name</th>
                            <th>Stakeholder Interests</th>

                            @for($i=0; $i<count($stakeholders); $i++) <tr>
                                <td>Stakeholder {{$i+1}}</td>
                                <td>{{$stakeholders[$i]->stakeholder}}</td>
                                <td>{{$stakeholders[$i]->interests}}</td>
                                </tr>
                                @endfor
                        </table>


                        @endif
                        <hr>
                        </hr>
                        <h3><u> Options:</u></h3>
                        @if (empty($options[0]->option))
                        <div>
                            <form method="GET" action="{{ route('options', $dashboard->id) }}">

                                <button type="submit" class="btn btn-danger">Create Options</button>
                            </form>
                        </div>


                        @else

                        <table class="table table-bordered">
                            <th width="25%"></th>
                            <th>Options</th>

                            @for($i=0; $i<count($options); $i++) <tr>
                                <td>Option {{$i+1}}</td>
                                <td>{{$options[$i]->option}}</td>

                                </tr>
                                @endfor
                        </table>

                        @endif
                        <hr>
                        </hr>
                        <div class="card-header">
                            <h1>Select an Ethical Framework to Begin</h1>

                        </div>
                        <table>
                            <tr>
                                <td>
                                    <form method="GET" action="course">
                                        <button type="submit" class="btn btn-primary" style="width: 200px">{{
                                            __('Utilitarianism') }} </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="GET" action="course">
                                        <button type="submit" class="btn btn-primary" style="width: 200px">{{
                                            __('Deontology') }} </button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <form method="GET" action="course">
                                        <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Virtue
                                            Ethics') }} </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="GET" action="course">
                                        <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Care
                                            Ethics') }} </button>
                                    </form>
                                </td>
                            </tr>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}} -->

<div>
    <a class="mb-2 btn btn-dark" href="{{route('casestudy.show', $casestudy->id)}}">
        ⏴Case Study
    </a> 
</div>

<div class="container mb-2">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link active" href="{{route('dashboard.show', $dashboard->id)}}">Summary</a>
        <a class="nav-link" href="{{route('ethicalissue.show', $ethicalissue->id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="#">Utilitarianism</a>
        <a class="nav-link" href="#">My Progress</a>
    </nav>
</div>

<div class="jumbotron">
    <div class="container">
        
        <div id="accordianId" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="ethicalIssueHeaderId">
                    <h5 class="mb-0">
                        <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#accordianId" href="#ethicalIssueContentId" aria-expanded="true" aria-controls="ethicalIssueContentId">
                        Ethical Issue and Options
                        </a>
                    </h5>
                </div>
                <div id="ethicalIssueContentId" class="collapse in" role="tabpanel" aria-labelledby="ethicalIssueHeaderId">
                    <div class="card-body">
                        @if(count($options)>0)
                            <p class="card-text"><b>Ethical Issue:</b> {{$ethicalissue->issue}}</p>
                            @for($i=0; $i<count($options); $i++)
                                
                                <p class="card-text"><b>Option {{$i+1}}:</b> {{$options[$i]->option}} </p>

                            @endfor
                        @else
                            <p class="card-text">No inputs have been made</p>                      
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="stakeholdersHeaderId">
                    <h5 class="mb-0">
                        <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#accordianId" href="#stakeholdersContentId" aria-expanded="true" aria-controls="stakeholdersContentId">
                            Stakeholders and Interests
                        </a>
                    </h5>
                </div>
                <div id="stakeholdersContentId" class="collapse in" role="tabpanel" aria-labelledby="stakeholdersHeaderId">
                    <div class="card-body">
                        @if(count($stakeholders)>0)
                            
                            @for($i=0; $i<count($stakeholders); $i++)
                                <p class="card-text"><b>Stakeholder {{$i+1}}:</b> {{$stakeholders[$i]->stakeholder}}</p>
                                <p class="card-text"><b>Interests:</b> {{$stakeholders[$i]->interests}} </p>
                                <br>
                            @endfor
                        @else
                            <p class="card-text">No inputs have been made</p>                      
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




@endsection
