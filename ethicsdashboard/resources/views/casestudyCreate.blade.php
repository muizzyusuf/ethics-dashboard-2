@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Case Study Creation
                </div>



                <form method="POST" action="{{route('caseStudyPost', ['course_id' => $course_id])}}">

                    {{ csrf_field() }}
                    <div class="card-body">


                        <div class="form-group">

                            <label for="title">Name:</label>

                            <input type="text" id="name" name="name" class="form-control">

                        </div>



                        <div class="form-group">

                            <label for="code">Instruction:</label>

                            
                            <textarea cols="30" rows="10" type="text" name="instruction" placeholder="Instructions" class="form-control"> </textarea>
                        </div>



                        <div class="form-group">

                            <label for="section">Course Code:</label>

                            <input type="text" id="course_id" name="course_id" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="code">Points:</label>

                            <input type="number" id="points" name="points" class="form-control">
        
                        </div>

                        <button type="submit" class="btn btn-primary">Add Case Study</button>

                    </div>


                </form>





            </div>
        </div>
    </div>
</div>
@endsection