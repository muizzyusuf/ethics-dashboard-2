@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Course Selection</div>
                
   @if(count($names)>0 && count($codes)>0)
   
        <ul>
           
        @foreach($codes as $code)
    
        
                <div class="card-body">
                <form method="GET" action="{{ route('home') }}">
                   <h3> {{$code}} </h3>
                  
                   <button type="submit" class="btn btn-primary">{{ __('Next') }} </button>
            </form>
                </div>
            
        @endforeach
    </ul>
    @endif

                
            </div>
        </div>
    </div>
</div>
@endsection
