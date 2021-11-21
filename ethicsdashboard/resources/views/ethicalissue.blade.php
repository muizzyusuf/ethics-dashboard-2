@extends('layouts.app')

@section('content')
 <div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

    <h2 align="center">Create Ethical Issue</h2> 

   
</div>

    <form action="{{ route('ethicalissues', $id) }}" method="POST">

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

   

        
               
                <textarea cols="30" rows="10" type="text" name="ethicalissues[0][issue]" placeholder="Enter the Ethical Issue to be Analyzed" class="form-control"> </textarea>  



    

                <button style="float:right; height:60px; width:200px" type="submit" class="btn btn-success"><h3>Save</h3></button>

    </form>

</div>
</div>
</div>

@endsection