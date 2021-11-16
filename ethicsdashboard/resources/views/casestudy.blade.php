@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Case Studies for {{$courseCode}}</div>

   
        <ul>
        <table>
        <tr>
        
        @foreach($names as $name)
    
            <th>
                <div class="card-body">
                
                  <h3> <u> {{$name}} </u></h3>
           
                </div>
            </th>
        @endforeach
</tr>
        <tr>
        @foreach($points as $point)
        <td>
                <div class="card-body">
                
                   <h5> Possible Points: {{$point}} </h5>
           
                </div>
            </td>
        @endforeach


            </tr>
            <tr>
            @foreach($ids as $id)
            <td>
            <div class="card-body">
            <a class="btn btn-success" href="{{route('casestudyInstr', ['id' => $id])}}">{{ __('Next') }} </a>
</td>                                                   
</div>
            @endforeach  
            </tr>
</table>


                
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Case Study Creation</h1></div>

        <div class="card-body">
            <form method="GET" action="{{route('csCreate', ['course_id' => $course_id])}}">
            <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Create a New Case Study') }} </button>
            </form>  
            </div>
    </ul>
    </div>
        </div>
    </div>
</div>
@endsection


