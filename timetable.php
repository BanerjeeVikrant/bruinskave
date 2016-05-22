<?php 
include "php/connect.php";
include "php/header.php";	
?>
<?php
$p0 = "";
$p1 = "Math";
$p2 = "English";
$p3 = "Spanish";
$p4 = "PE";
$p5 = "Robotics";
$p6 = "Social Science";
$p7 = "";

$teacher0 = "";
$teacher1 = "Sparks";
$teacher2 = "Kennedy";
$teacher3 = "mcfadyen";
$teacher4 = "burk";
$teacher5 = "ghasemi";
$teacher6 = "rohna";
$teacher7 = "";
?>

    <title>Timetable</title>
    <style type="text/css">
	table{
		box-shadow: 6px 6px 15px #A79696;
	}

    th,td{
        text-align: center;
        border-collapse: collapse;
        outline: 1px solid #e3e3e3;
		font-size: 20px;
        font-family: verdana;
    }

    td{
        padding: 5px 10px;
		height: calc(80vh / 10);
		background: white;
    }

    th{
        background: #666;
        color: white;
        padding: 5px 10px;
		height: calc(80vh / 10);
    }

    td:hover{
        cursor: pointer;
        background: #666;
        color: white;
    }
	.table_holder{
		background: #e2e8eb;
		padding-top: calc(((100vh - 80vh)/2));
	}
    
    </style>

</head>
<body>
<div class = "table_holder">
	<table width="90%" align="center" >
		<div id="head_nav">
		<tr>
			<th>Period</th>
			<th>Class</th>
			<th>Teacher</th>
		</tr>
		</div>  

		<tr>
			<th>P0(A-B)</th>
				<td><?php echo $p0;?></td>
				<td><?php echo $teacher0;?></td>
			</div>
		</tr>

		<tr>
			<th>P1(A)</td>
				<td><?php echo $p1;?></td>
				<td><?php echo $teacher1;?></td>
			</div>
		</tr>

		<tr>
			<th>P2(A)</td>
				<td><?php echo $p2;?></td>
				<td><?php echo $teacher2;?></td>
			</div>
		</tr>

		<tr>
			<th>P3(A)</td>
				<td><?php echo $p3;?></td>
				<td><?php echo $teacher3;?></td>
			</div>
		</tr>

		<tr>
			<th>P4(B)</td>
				<td><?php echo $p4;?></td>
				<td><?php echo $teacher4;?></td> 
			</div>
		</tr>
		<tr>
			<th>P5(B)</td>
				<td><?php echo $p5;?></td>
				<td><?php echo $teacher5;?></td> 
			</div>
		</tr>
		<tr>
			<th>P6(B)</td>
				<td><?php echo $p6;?></td>
				<td><?php echo $teacher6;?></td> 
			</div>
		</tr>
		<tr>
			<th>P7(A-B)</td>
				<td><?php echo $p7;?></td>
				<td><?php echo $teacher7;?></td> 
			</div>
		</tr>
	</table>
</div>
</body>
</html>