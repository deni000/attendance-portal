<?php

//attendance_action.php

include('database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM attendance_tbl 
		INNER JOIN student_tbl
		ON student_tbl.student_id = attendance_tbl.student_id 
		INNER JOIN class_tbl 
		ON class_tbl.class_id = student_tbl.student_class_id 
		INNER JOIN teacher_tbl 
		ON teacher_tbl.teacher_id = attendance_tbl.teacher_id 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
				WHERE student_tbl.student_name LIKE "%'.$_POST["search"]["value"].'%" 
				OR student_tbl.student_roll_no LIKE "%'.$_POST["search"]["value"].'%" 
				OR attendance_tbl.attendance_status LIKE "%'.$_POST["search"]["value"].'%" 
				OR attendance_tbl.attendance_date LIKE "%'.$_POST["search"]["value"].'%" 
				OR teacher_tbl.teacher_name LIKE "%'.$_POST["search"]["value"].'%" 
			';
		}
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' 
			';
		}
		else
		{	
			$query .= '
			ORDER BY attendance_tbl.attendance_id DESC 
			';
		}

		if($_POST["length"] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row)
		{
			$sub_array = array();
			$status = '';
			if($row["attendance_status"] == "Present")
			{
				$status = '<label class="badge badge-success">Present</label>';
			}
			if($row["attendance_status"] == "Absent")
			{
				$status = '<label class="badge badge-danger">Absent</label>';
			}
			$sub_array[] = $row["student_name"];
			$sub_array[] = $row["student_roll_no"];
			$sub_array[] = $row["class_name"];
			$sub_array[] = $status;
			$sub_array[] = $row["attendance_date"];
			$sub_array[] = $row["teacher_name"];
			$data[] = $sub_array;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'attendance_tbl'),
			"data"				=>	$data
		);

		echo json_encode($output);
	}

	if($_POST["action"] == "index_fetch")
	{
		$query = "
		SELECT * FROM student_tbl 
		LEFT JOIN attendance_tbl
		ON attendance_tbl.student_id = student_tbl.student_id 
		INNER JOIN class_tbl 
		ON class_tbl.class_id = student_tbl.student_class_id 
		INNER JOIN teacher_tbl 
		ON teacher_tbl.teacher_class_id = class_tbl.class_id  
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			WHERE student_tbl.student_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR student_tbl.student_roll_no LIKE "%'.$_POST["search"]["value"].'%" 
			OR class_tbl.class_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR teacher_tbl.teacher_name LIKE "%'.$_POST["search"]["value"].'%" 
			';
		}
		$query .= 'GROUP BY student_tbl.student_id ';
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= 'ORDER BY student_tbl.student_name ASC ';
		}

		if($_POST["length"] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row)
		{
			$sub_array = array();
			$sub_array[] = $row["student_name"];
			$sub_array[] = $row["student_roll_no"];
			$sub_array[] = $row["class_name"];
			$sub_array[] = $row["teacher_name"];
			$sub_array[] = get_attendance_percentage($connect, $row["student_id"]);
			$sub_array[] = '<button type="button" name="report_button" data-student_id="'.$row["student_id"].'" class="btn btn-info btn-sm report_button">Report</button>&nbsp;&nbsp;&nbsp;<button type="button" name="chart_button" data-student_id="'.$row["student_id"].'" class="btn btn-danger btn-sm report_button">Chart</button>
			';
			$data[] = $sub_array;
		}

		$output = array(
			'draw'				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'student_tbl'),
			"data"				=>	$data
		);

		echo json_encode($output);
	}
}


?>