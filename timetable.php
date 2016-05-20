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
<!doctype html>
<html>
<head>
    <title>Timetable</title>
    <style type="text/css">

    th,td
    {
        margin: 0;
        text-align: center;
        border-collapse: collapse;
        outline: 1px solid #e3e3e3;
		font-size: 15px;
    }

    td
    {
        padding: 5px 10px;
		height: calc(80vh / 10);
    }

    th
    {
        background: #666;
        color: white;
        padding: 5px 10px;
		height: calc(80vh / 10);
    }

    td:hover
    {
        cursor: pointer;
        background: #666;
        color: white;
    }
    </style>

</head>
<body>
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
</body>
</html>