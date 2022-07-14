<?php

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=bca_attendance","root","");

$base_url = "http://localhost/BCAattendance";

function get_total_records($connect, $table_name)
{
	$query = "SELECT * FROM $table_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function load_class_list($connect)
{
	$query = "
	SELECT * FROM class_tbl ORDER BY class_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["class_id"].'">'.$row["class_name"].'</option>';
	}
	return $output;
}

function get_attendance_percentage($connect, $student_id)
{
	$query = "
	SELECT 
		ROUND((SELECT COUNT(*) FROM attendance_tbl 
		WHERE attendance_status = 'Present' 
		AND student_id = '".$student_id."') 
	* 100 / COUNT(*)) AS percentage FROM attendance_tbl 
	WHERE student_id = '".$student_id."'
	";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		if($row["percentage"] > 0)
		{
			return $row["percentage"] . '%';
		}
		else
		{
			return 'NA';
		}
	}
}

function Get_student_name($connect, $student_id)
{
	$query = "
	SELECT student_name FROM student_tbl 
	WHERE student_id = '".$student_id."'
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		return $row["student_name"];
	}
}

function Get_student_class_name($connect, $student_id)
{
	$query = "
	SELECT class_tbl.class_name FROM student_tbl 
	INNER JOIN class_tbl 
	ON class_tbl.class_id = student_tbl.student_class_id 
	WHERE student_tbl.student_id = '".$student_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['class_name'];
	}
}

function Get_student_teacher_name($connect, $student_id)
{
	$query = "
	SELECT teacher_tbl.teacher_name 
	FROM student_tbl 
	INNER JOIN class_tbl 
	ON class_tbl.class_id = student_tbl.student_class_id 
	INNER JOIN teacher_tbl 
	ON teacher_tbl.teacher_class_id = class_tbl.class_id 
	WHERE student_tbl.student_id = '".$student_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["teacher_name"];
	}
}

function Get_class_name($connect, $class_id)
{
	$query = "
	SELECT class_name FROM class_tbl 
	WHERE class_id = '".$class_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["class_name"];
	}
}

?>