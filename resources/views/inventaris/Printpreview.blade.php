<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
	<style type="text/css">
		table{
			border: 1px solid;
			border-collapse: collapse;
			width: 70%;
			margin: 0 auto;

		}
		tr th{
			background: #eee;
			border: 1px solid;
		}
		tr td{
			border: 1px solid;
		}
		caption{
			text-align: left;
		}
	</style>
</head>
<body>

<body>
	<table>
		<caption><h1>Report</h1></caption>
		<thead>
			<tr>
                            <th scope="coll">Id Inventaris</th>
                            <th scope="coll">Nama</th>
                            <th scope="coll">Kondisi</th>
                            <th scope="coll">Keterangan</th>
                            <th scope="coll">Id Jenis</th>
                            <th scope="coll">Id Ruang</th>
                           
                    </tr>
		</thead>
		<tbody>
			 @foreach($inventaris ->all() as $inventaris)

                  <tr>
                    <td>{{$inventaris->id_inventaris}}</td>
                    <td>{{$inventaris->nama}}</td>
                    <td>{{$inventaris->kondisi}}</td>
                    <td>{{$inventaris->keterangan}}</td>
                    <td>{{$inventaris->jumlah}}</td>
                    <td>{{$inventaris->id_jenis}}</td>
                    <td>{{$inventaris->id_ruang}}</td>
                    
                  
                   
                  </tr>
           @endforeach
		</tbody>
	</table>
</body>

</body>
</html>