@extends('layouts.app')

@section('content')
 <div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

    <h2 align="center">Short-Term Consequence Assessment</h2> 

   
</div>

    <form action="{{ route('pleasures.store', $dashboard->id) }}" method="POST">

        @csrf

   

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

   

        @if (Session::has('success'))

            <div class="alert alert-success text-center">

                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                <p>{{ Session::get('success') }}</p>

            </div>

        @endif

   
        <table  class="table table-bordered">
                    <th width="25%"></th><th>Options</th> <th>Pleasure Rating</th>

                        @for($i=0; $i<count($options); $i++)
                        <tr>
                            <td>Option {{$i+1}}</td>
                            <td>{{$options[$i]->option}}</td> <td></td>
                            <tr>  
                @for($j=0; $j<count($stakeholders); $j++)
                <tr>
                <td><h5> Stakeholder {{$j+1}} </h5></td>
                <td><textarea cols="30" rows="10" type="text" name="pleasures[0][pleasure]" placeholder="Enter Name of Stakeholder" class="form-control"> </textarea></td>  
                <td><div class="slidecontainer">
  Painful<input type="range" min="1" max="100" value="50" class="slider" id="myRange">Pleasurable
</div></td>
            </tr>   
                @endfor
            
            </tr>  
                         
                    </tr>
                        @endfor
                        </table>

    

        <button style="float:right; height:60px; width:200px" type="submit" class="btn btn-success"><h3>Save</h3></button>

    </form>

</div>
</div>
</div>

@endsection