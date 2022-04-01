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
        <h3>Utilitarianism Summary: </h3>
        <div>Decision: {{$utilitarianism->decision}}</div>
        <div>*Aggregate Summary of Pleasure Analysis can be found Under the <em>Summary</em> tab on the Dashboard Page</div>
        </td>
      </tr>
      <tr>
        <td>
        <h3>Virtue Ethics Summary</h3>
        @for($i=0; $i<count($oVirtues); $i+=2)

          <div> {{$oVirtues[$i+1]->option}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Virtue: {{$oVirtues[$i]->virtue}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Vice (Excess): {{$oVirtues[$i]->excess}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Virtue (Mean): {{$oVirtues[$i]->mean}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Vice (Deficiency): {{$oVirtues[$i]->deficiency}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Value: {{$oVirtues[$i]->value}}</div>
            
         
          </td>
      </tr>
      <tr>
        <td>
        @endfor 
        @for($i=0; $i<count($sVirtues); $i+=2)

          <div> {{$sVirtues[$i+1]->stakeholder}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Virtue: {{$sVirtues[$i]->virtue}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Vice (Excess): {{$sVirtues[$i]->excess}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Virtue (Mean): {{$sVirtues[$i]->mean}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Vice (Deficiency): {{$sVirtues[$i]->deficiency}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Value: {{$sVirtues[$i]->value}}</div>
            

        @endfor 
        </td>
      </tr>
      
        <h3>Care Ethics Summary</h3>
        @for($i=0; $i<count($cares); $i++)
        <tr>
          <td>
        <div>Care Analysis for {{$cares[$i][2]->stakeholder}}'s Choice in "{{$cares[$i][1]->option}}:"</div>
        
          <div style="margin-left:2em; padding-bottom: 0;">Attentiveness: {{$cares[$i][0]->attentiveness}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Competence: {{$cares[$i][0]->competence}}</div>
          <div style="margin-left:2em; padding-bottom: 0;">Responsiveness: {{$cares[$i][0]->responsiveness}}</div>
          </td>
      </tr>
        @endfor

      
      
      <h3>Deontology Summary</h3>
      <h4>Option Analysis</h4>
      @for($i=0; $i<count($motivations); $i+=2)
      <tr>
        <td>
      <div>Option: {{$motivations[$i+1]->option}}</div>
        @for($j=0; $j<count($motivations[$i]); $j++)
        <div style="margin-left:2em; padding-bottom: 0;">Motivation: {{$motivations[$i][$j]->motivation}}</div>
       @endfor 
      </td>
    </tr>
      @endfor

      <h4>Moral Issues and Moral Laws</h4>
      @for($i=0; $i<count($moralIssuesLaws); $i+=3)
      <tr>
        <td>
      <div>Moral Laws for Option "{{$moralIssuesLaws[$i+2]->option}}":</div>
        @for($j=0; $j<count($moralIssuesLaws[$i+1]); $j++)
        <div style="margin-left:2em; padding-bottom: 0;">{{$j+1}}. {{$moralIssuesLaws[$i+1][$j]->moral_law}}</div>
        <div style="margin-left:3em; padding-bottom: 0;">Can this law be a universal law of moral action? {{$moralIssuesLaws[$i+1][$j]->universalizability}}.</div>
        <div style="margin-left:3em; padding-bottom: 0;">Explanation: {{$moralIssuesLaws[$i+1][$j]->uni_explain}}</div>
        <div style="margin-left:3em; padding-bottom: 0;">Could you live in a world where everyone followed this law? {{$moralIssuesLaws[$i+1][$j]->consistency}}.</div>
        <div style="margin-left:3em; padding-bottom: 0;">Explanation: {{$moralIssuesLaws[$i+1][$j]->con_explain}}</div>
        @endfor 
      </td>
    </tr>
      @endfor

      </tr>
      
      <h3>Grades Summary</h3>
     <tr>
        <td>
      <div>Utilitarianism Section Grade: {{$utilitarianism->grade}}</div>
        <div style="margin-left:2em; padding-bottom: 0;">Comment: {{$utilitarianism->comment}}</div>
      <div>Virtue Ethics Section Grade: {{$virtue->grade}}</div>
        <div style="margin-left:2em; padding-bottom: 0;">Comment: {{$virtue->comment}}</div>
      <div>Care Ethics Section Grade: {{$care->grade}}</div>
        <div style="margin-left:2em; padding-bottom: 0;">Comment: {{$care->comment}}</div>
      <div>Deontology Section Grade: {{$deontology->grade}}</div>
        <div style="margin-left:2em; padding-bottom: 0;">Comment: {{$deontology->comment}}</div>
      <div>Ethical Issue and Options Grade: {{$ethicalIssue->grade}}</div>
        <div style="margin-left:2em; padding-bottom: 0;">Comment: {{$ethicalIssue->comment}}</div>
      
      
        </td>
    </tr>
      
      
    </table>
  </body>
</html>