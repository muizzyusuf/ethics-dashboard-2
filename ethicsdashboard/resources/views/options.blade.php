<!-- ETHICAL ISSUE SECTION FOR ETHICSDASHBOARD-->

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Ethical Issue 
                </div>


                <form method="POST" action="{{route('ethicalIssuePost')}}">

                    {{ csrf_field() }}
                    <div class="card-body">


                        <p>Instruction for creating An Ethical Issue</p>
                        <p>
                            Describe the ethical issue or dilemma you would like to analyze.
                            Remember, that ethical values are things that are important because they are right or wrong -
                            lying, courage, loyalty, theft, etc.
                        </p>



                        <div class="form-group">

                            <label for="ethicalIssue">Ethical Issue:</label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Enter Ethical Issue Here" id="ethicalIssue" name="ethicalIssue" class="form-control">

                        </div>

                        <button style = "text-align:centre" type="submit" class="btn btn-primary">Submit</button>

                    </div>

                  

                <!--</form>-->

            </div>
        </div>
    </div>
</div>


<!-- OPTIONS SECTION FOR ETHICSDASHBOARD-->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Options
                </div>




                    {{ csrf_field() }}
                    <div class="card-body">


                        <div class="form-group">

                            <label for="option1">Option 1</label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Enter Option 1 here" id="option1" name="option1" class="form-control">

                        </div>



                        <div class="form-group">

                            <label for="option2">Option 2</label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Enter Option 2 here" id="option2" name="option2" class="form-control">

                        </div>



                        <div class="form-group">

                            <label for="option3">Option 3</label>

                            <input type="text" style="height:120px; width:650px;" placeholder="Enter Option 3 here" id="option3" name="option3" class="form-control">

                        </div>



                        <div class="form-group">

                            <label for="option4">Option 4</label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Enter Option 4 here" id="option4" name="option4" class="form-control">

                        </div>

                        <button style = "text-align:centre" type="submit" class="btn btn-primary">Submit</button>


                    </div>

                    


                <!--</form>-->

            </div>
        </div>
    </div>
</div>
@endsection





