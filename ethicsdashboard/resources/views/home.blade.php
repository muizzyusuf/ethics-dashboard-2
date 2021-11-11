@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Course Selection</div>

   
        <ul>
        <table style="float:right">
        <tr>
        @foreach($codes as $code)
    
            <th>
                <div class="card-body">
                
                  <h3> <u> {{$code}} </u></h3>
            </form>
                </div>
            </th>
        @endforeach
</tr>
        <tr>
        @foreach($names as $name)
        <td>
                <div class="card-body">
                
                   <h5> {{$name}} </h5>
            </form>
                </div>
            </td>
        @endforeach


            </tr>
            <tr>
            @foreach($ids as $id)
            <td>
            <div class="card-body">
            <a class="btn btn-success" href="{{route('casestudy', ['course_id' => $id])}}">{{ __('Next') }} </a>
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
                <div class="card-header"><h1>Course Creation</h1></div>

        <div class="card-body">
            <form method="GET" action="course">
            <button type="submit" class="btn btn-primary" style="width: 200px">{{ __('Create a New Course') }} </button>
            </form>  
            </div>
    </ul>
    </div>
        </div>
    </div>
</div>
@endsection
