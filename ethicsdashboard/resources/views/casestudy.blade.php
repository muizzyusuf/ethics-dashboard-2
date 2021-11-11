@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Course Selection</div>
                
   @if(count($names))
   
        <ul>
           
        @foreach($codes as $code)
    
        
                <div class="card-body">
                <form method="GET" action="{{ route('/casestudy/{course_id}') }}">
                   <h3> {{$code}} </h3>
                  
                   <button type="submit" class="btn btn-primary">{{ __('Next') }} </button>
            </form>
                </div>
            
        @endforeach
        <div class="card-body">
                <form method="GET" action="course">
                   <h3> Create and Add a New Course </h3>
                  
                   <button type="submit" class="btn btn-primary">{{ __('Create') }} </button>
            </form>
                </div>
    </ul>
    @endif
    
            

                
            </div>
        </div>
    </div>
</div>
@endsection
