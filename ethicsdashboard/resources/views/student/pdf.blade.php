<!-- pdf.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
      <tr>
        <td>
          {{$dashboard->name}}
        </td>
        <td>
          {{$dashboard->summary}}
        </td>
      </tr>
      <tr>
        <td>
          {{$dashboard->role}}
        </td>
        <td>
          {{$dashboard->dilemma}}
        </td>
      </tr>
    </table>
  </body>
</html>