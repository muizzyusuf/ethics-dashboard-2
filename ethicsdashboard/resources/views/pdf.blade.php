<!-- pdf.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dashboard Summary</title>
  </head>
  <body>
    <h1> {{$user->name}}'s Dashboard Summary </h1>
    <table class="table table-bordered">
      <tr>
    
        <td>
        <h3>Dashboard Name: </h3> {{$dashboard->name}}
        </td>
      </tr>
      <tr>
        <td>
        <h3>Summary: </h3>{{$dashboard->summary}}
        </td>
      </tr>
      <tr>
        <td>
        <h3>Role: </h3> {{$dashboard->role}}
        </td>
      </tr>
      <tr>
        <td>
        <h3>Dilemma: </h3>{{$dashboard->dilemma}}
        </td>
      </tr>
      <tr>
        <td>
        <h3>Ethical Issue: </h3>{{$ethicalIssue->issue}}
        </td>
      </tr>
      <tr>
        <td>
        <h3>Options: </h3>
        <ol>
        @for($i=0; $i<count($options); $i++)
        
        <li>{{$options[$i]->option}}
        <ol style="list-style-type: lower-alpha; padding-bottom: 0;">
          @for($j=0; $j<count($consequences); $j++)
            @if($consequences[$j]->option_id == $options[$i]->id)
              <li style="margin-left:2em; padding-bottom: 0;">
                @if($consequences[$j]->type=='long') Long Term Consequence: 
                @else Short Term Consequence: 
                @endif {{$consequences[$j]->consequence}}</li>
              @endif
              
          @endfor
        </ol>
</li>
        @endfor
      </ol>
  
        </td>
      </tr>
      <tr>
        <td>
        <h3>Stakholders and Interests: </h3>
        @for($i=0; $i<count($stakeholders); $i++)

        <div>Stakeholder {{$i+1}}: {{$stakeholders[$i]->stakeholder}}</div>
        <div style="margin-left:2em; padding-bottom: 0;">Interest: {{$stakeholders[$i]->interests}}</div>
          @for($j=0; $j<count($impacts); $j++)
            @if($impacts[$j]->stakeholder_id==$stakeholders[$i]->id) 
            <div style="margin-left:2em; padding-bottom: 0;">Impact: {{$impacts[$j]->impact}}</div>
            <div style="margin-left:2em; padding-bottom: 0;">Impact Rank: {{$impacts[$j]->rank}}</div>
            @endif
          @endfor
        @endfor
  
        </td>
      </tr>
      <tr>
        <td>
        <h3>Utilitarianism Decision: </h3>
        <div>{{$utilitarianism->decision}}</div>
        </td>
      </tr>
    </table>
  </body>
</html>