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

{{$dashboard->name}}
@endsection