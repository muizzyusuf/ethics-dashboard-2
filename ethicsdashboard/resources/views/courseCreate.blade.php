@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Course Creation
                </div>



                <form method="POST" action="{{route('coursePost')}}">

                    {{ csrf_field() }}
                    <div class="card-body">


                        <div class="form-group">

                            <label for="title">Title:</label>

                            <input type="text" id="title" name="title" class="form-control">

                        </div>



                        <div class="form-group">

                            <label for="code">Course Code:</label>

                            <input type="text" id="code" name="code" class="form-control">

                        </div>



                        <div class="form-group">

                            <label for="section">Number:</label>

                            <input type="number" id="number" name="number" class="form-control">

                        </div>



                        <div class="form-group">

                            <label for="section">Section:</label>

                            <input type="number" id="section" name="section" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="year">Year:</label>

                            <input type="text" id="year" name="year" class="form-control">

                        </div>


                        <button type="submit" class="btn btn-primary">Add</button>

                    </div>


                </form>





            </div>
        </div>
    </div>
</div>
@endsection