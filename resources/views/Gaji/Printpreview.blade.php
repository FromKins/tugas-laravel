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
                            <th scope="coll">Karyawan</th>
                            <th scope="coll">Upah Perjam</th>
                            <th scope="coll">Hari</th>
                            <th scope="coll">Jam</th>
                            <th scope="coll">Total Gaji</th>
                    </tr>
		</thead>
		<tbody>
			 @foreach($gaji ->all() as $gaji)

                  <tr>
                    <td>{{$gaji->karyawan_id}}</td>
                    <td>{{$gaji->gaji}}</td>
                    <td>{{$gaji->hari}}</td>
                    <td>{{$gaji->jam}}</td>
                    <td>{{$gaji->totalgaji}}</td>
                  
                   
                  </tr>
           @endforeach
		</tbody>
	</table>
</body>

</body>
</html>