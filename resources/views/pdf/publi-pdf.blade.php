<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <style>
    .page-break {
        page-break-after: always;
    }
    table, td, th {
            border: 1px solid black;
        }

table {
       border-collapse: collapse;
       width: 100%;
        }

.table-no-border tr td th{
      border : none;
 }

 td {
    height: 10px;
    vertical-align: middle;
    text-align: left;
  }
    </style>
    <h1>Lista Publicaciónes</h1>
    <table>
        <tr>
            <td>ID</td>
            <td>TITULO</td>
            <td>EMPRESA</td>
            <td>TIPO</td>
            <td>NIVEL</td>
            <td>SALARIO</td>
        </tr>
        @foreach ($publicaciones as $publi )
        <tr>
            <td>{{ $publi->id }}</td>
            <td>{{ $publi->titulo }}</td>
            <td>{{ $publi->empresa->nombre }}</td>
            <td>{{ $publi->tipo }}</td>
            <td>{{ $publi->nivel }}</td>
            <td>{{ $publi->salario }}</td>
        </tr>
            
        @endforeach

    </table>
    <!--div class="page-break"></div--> 
    <img width="500px" src="https://quickchart.io/chart?c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Users',data:[120,60,50,180,120]}]}}">
</body>
</html>
