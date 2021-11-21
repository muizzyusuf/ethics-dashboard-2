@extends('layouts.app')

@section('content')
 <div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

    <h2 align="center">Create Stakeholders</h2> 

   
</div>

    <form action="{{ route('stakeholders', $id) }}" method="POST">

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

   

        <table class="table table-bordered" id="dynamicTable">  

            <tr>

                <th width="25%" >Stakeholder #</th>

                <th>Stakeholder Name</th>

                <th>Stakeholder Interests</th>


               

              

            </tr>

            <tr>  
                <td><h5> Stakeholder 1 </h5></td>
                <td><textarea cols="30" rows="10" type="text" name="stakeholders[0][stakeholder]" placeholder="Enter Name of Stakeholder" class="form-control"> </textarea></td>  

                <td><textarea cols="30" rows="10" type="text" name="stakeholders[0][interests]" placeholder="Enter Stakeholder Interests" class="form-control"> </textarea></td>  
          

            </tr>  
            <tr>  
                <td><h5> Stakeholder 2 </h5></td>
                <td><textarea cols="30" rows="10" type="text" name="stakeholders[1][stakeholder]" placeholder="Enter Name of Stakeholder" class="form-control"> </textarea></td>  

                <td><textarea cols="30" rows="10" type="text" name="stakeholders[1][interests]" placeholder="Enter Stakeholder Interests" class="form-control"> </textarea></td>  

            </tr>  
  <tr>  
                <td><h5> Stakeholder 3 </h5></td>
                <td><textarea cols="30" rows="10" type="text" name="stakeholders[2][stakeholder]" placeholder="Enter Name of Stakeholder" class="form-control"> </textarea></td>  

                <td><textarea cols="30" rows="10" type="text" name="stakeholders[2][interests]" placeholder="Enter Stakeholder Interests" class="form-control"> </textarea></td>  


          

            </tr> 
            
            

        </table> 

    

        <button style="float:right; height:60px; width:200px" type="submit" class="btn btn-success"><h3>Save</h3></button>

    </form>

</div>
</div>
</div>

@endsection