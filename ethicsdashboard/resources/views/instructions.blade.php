@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Instructions for {{$name[0]}}</div>
    <h3><u> Instructions </u></h3>
    <p>{{$instruction[0]}}</p>
    <h3><u> Points</u></h3>
    <p>{{$points[0]}}</p>
    
    <a class="btn btn-success" href="{{route('dashboard', ['case_study_id'=>$id[0]])}}">Next</a>
                                      
   
            </div>
        </div>
    </div>
</div>
@endsection


