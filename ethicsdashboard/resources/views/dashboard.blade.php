@extends('layouts.app')

@section('content')
<!-- {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Dashboard Creation</h1>

                    <form method="POST" action="{{route('dashboardPost', ['case_study_id' => $case_study_id[0]])}}">

        {{ csrf_field() }}
        <div class="card-body">


            <div class="form-group">

                <label for="title">Title of Dashboard:</label>

                <input type="text" id="name" name="name" class="form-control">

            </div>

            
            <div>


            <button type="submit" class="btn btn-primary">Create</button>

            </div>
        </form>


            </div>
        </div>
    </div>
</div> --}} -->

 <div class="container">
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
                    <hr></hr>
                <h3><u> Stakeholders:</u></h3>
            @if (empty($stakeholders[0]->id))
            <div>
                    <form method="GET" action="{{ route('stakeholders', $dashboard->id) }}">
                    
                    <button type="submit" class="btn btn-danger">Create Stakeholders</button>
                     </form>
                    </div>
                
                    
                    @else 
                    
                    <table  class="table table-bordered">
                    <th width="25%"></th><th>Stakeholder Name</th><th>Stakeholder Interests</th>

                        @for($i=0; $i<count($stakeholders); $i++)
                        <tr>
                            <td>Stakeholder {{$i+1}}</td>
                            <td>{{$stakeholders[$i]->stakeholder}}</td>
                            <td>{{$stakeholders[$i]->interests}}</td>
                    </tr>
                        @endfor
                        </table>
                    
                    
                    @endif
                    <hr></hr>
                    <h3><u> Options:</u></h3>
            @if (empty($options[0]->option))
            <div>
                    <form method="GET" action="{{ route('options', $dashboard->id) }}">
                    
                    <button type="submit" class="btn btn-danger">Create Options</button>
                     </form>
                    </div>
                   
                    
                    @else 
                    
                    <table  class="table table-bordered">
                    <th width="25%"></th><th>Options</th>

                        @for($i=0; $i<count($options); $i++)
                        <tr>
                            <td>Option {{$i+1}}</td>
                            <td>{{$options[$i]->option}}</td>
                         
                    </tr>
                        @endfor
                        </table>
                    
                    @endif
                    <hr></hr>
                    <div class="card-header">
                    <h1>Select an Ethical Framework to Begin</h1>
                    
                    </div>
                    <table>
                    <tr>
                        <td>
                    <form method="GET" action="course">
                    <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Utilitarianism') }} </button>
                    </form> 
</td>
                    <td>
                    <form method="GET" action="course">
                    <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Deontology') }} </button>
                    </form> 
</td>
                    </tr>
                    <tr>
                        <td>
                    <form method="GET" action="course">
                    <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Virtue Ethics') }} </button>
                    </form> 
</td>
                    <td>
                    <form method="GET" action="course">
                    <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Care Ethics') }} </button>
                    </form> 
</td>
</tr>
                </table>    

                   
</div>
                </div>
        </div>
    </div>
</div>
@endsection