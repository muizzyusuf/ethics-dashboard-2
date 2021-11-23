
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Utilitarianism: Analyzing the Options
                </div>


                <form method="POST" action="">

                    {{ csrf_field() }}
                    <div class="card-body">


                        <p>Utilitarianism is a consequentialist theory:</p>
                        <p>
                            This means that the moral worth of an action is determined by the consequences
                            of the options. The first step is to consider the consequences, both short-term and long-term,
                            for the options you have identified. 
                        </p>

                        <!--Option 1 w/t short-term & long/term inputs-->
                        <div class="form-group">

                            <label for="option1">Option 1</label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Option 1 here" id="option1" name="option1" class="form-control">

                        </div>
                        <div class="form-group">

                            <label for="shortTerm1">Short-term Consequences</label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Short-term consequences" id="shortTerm1" name="shortTerm1" class="form-control">

                        </div>
                        <div class="form-group">

                            <label for="longTerm2">Long-Term Consequences </label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Long-term consequences" id="shortTerm2" name="shortTerm2" class="form-control">

                        </div>


                        <!--Option 2 w/t short-term & long/term inputs-->
                        <div class="form-group">

                            <label for="option2">Option 2</label>

                            <input type="text" style="height:120px; width:650px;" placeholder="Option 2 here" id="option2" name="option2" class="form-control">
                        </div>
                        <div class="form-group">

                            <label for="shortTerm2">Short-Term Consequences </label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Short-term consequences" id="shortTerm2" name="shortTerm2" class="form-control">

                        </div>
                        <div class="form-group">

                            <label for="longTerm2">Long-Term Consequences </label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Long-term consequences" id="longTerm2" name="longTerm2" class="form-control">

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        
                    </div>


                </form>

            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Utilitarianism: Analyzing the Stakeholders
                </div>


                <form method="POST" action="">

                    {{ csrf_field() }}
                    <div class="card-body">

                        <p>
                            Provide reasons why you have included each stakeholder. Move stakeholders up or 
                            down to rank according to the degree of impact. 
                        </p>
                        <p>
                            Example: Stakeholder 1 experiences the highest impact
                            Note: you may want to remove stakeholders if you can't identify how they 
                            will be impacted or if there is very little impact. 
                            Also, you may add stakeholders at anytime
                        </p>

                        
                        <div class="form-group">

                            <label for="stakeholder1">Stakeholder 1</label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Stakeholder 1 here" id="stakeholder1" name="stakeholder1" class="form-control">

                        </div>
                        <div class="form-group">

                            <label for="reason1">Your Reason: </label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Enter your reason here" id="reason1" name="reason2" class="form-control">

                        </div>
                       

                        
                        <div class="form-group">

                            <label for="stakeholder2">Stakeholder 2</label>

                            <input type="text" style="height:120px; width:650px;" placeholder="Stakeholder 2 here" id="stakeholder2" name="stakeholder2" class="form-control">
                        </div>
                        <div class="form-group">

                            <label for="reason1">Your Reason: </label>

                            <input type="text" style="height:120px; width:650px;"  placeholder ="Enter your reason here" id="reason2" name="reason2" class="form-control">

                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>
@endsection

