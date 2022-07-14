<?php

//student_action.php

include('database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM student_tbl 
		INNER JOIN class_tbl 
		ON class_tbl.class_id = student_tbl.student_class_id 
		";

		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			WHERE student_tbl.student_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR student_tbl.student_roll_no LIKE "%'.$_POST["search"]["value"].'%" 
			OR student_tbl.student_dob LIKE "%'.$_POST["search"]["value"].'%" 
			OR class_tbl.class_name LIKE "%'.$_POST["search"]["value"].'%" 
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
			ORDER BY student_tbl.student_id DESC 
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
			$sub_array[] = $row["student_name"];
			$sub_array[] = $row["student_roll_no"];
			$sub_array[] = $row["student_dob"];
			$sub_array[] = $row["class_name"];
			$sub_array[] = '<button type="button" name="edit_student" class="btn btn-primary btn-sm edit_student" id="'.$row["student_id"].'">Edit</button>';
			$sub_array[] = '<button type="button" name="delete_student" class="btn btn-danger btn-sm delete_student" id="'.$row["student_id"].'">Delete</button>';
			$data[] = $sub_array;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'student_tbl'),
			"data"				=>	$data
		);

		echo json_encode($output);
	}

	if($_POST["action"] == 'Add' || $_POST["action"] == "Edit")
	{
		$student_name = '';
		$student_roll_no = '';
		$student_dob = '';
		$student_class_id = '';
		$error_student_name = '';
		$error_student_roll_no = '';
		$error_student_dob = '';
		$error_student_class_id = '';
		$error = 0;
		if(empty($_POST["student_name"]))
		{
			$error_student_name = 'Student Name is required';
			$error++;
		}
		else
		{
			$student_name = $_POST["student_name"];
		}
		if(empty($_POST["student_roll_no"]))
		{
			$error_student_roll_no = 'Student Roll Number is required';
			$error++;
		}
		else
		{
			$student_roll_no = $_POST["student_roll_no"];
		}
		if(empty($_POST["student_dob"]))
		{
			$error_student_dob = 'Student Date of Birth is required';
			$error++;
		}
		else
		{
			$student_dob = $_POST["student_dob"];
		}
		if(empty($_POST["student_class_id"]))
		{
			$error_student_class_id = "Semester is required";
			$error++;
		}
		else
		{
			$student_class_id = $_POST["student_class_id"];
		}
		if($error > 0)
		{
			$output = array(
				'error'							=>	true,
				'error_student_name'			=>	$error_student_name,
				'error_student_roll_no'		=>	$error_student_roll_no,
				'error_student_dob'				=>	$error_student_dob,
				'error_student_class_id'		=>	$error_student_class_id
			);
		}
		else
		{
			if($_POST["action"] == 'Add')
			{
				$data = array(
					':student_name'		=>	$student_name,
					':student_roll_no'	=>	$student_roll_no,
					':student_dob'		=>	$student_dob,
					':student_class_id'	=>	$student_class_id
				);
				$query = "
				INSERT INTO student_tbl 
				(student_name, student_roll_no, student_dob, student_class_id) 
				VALUES (:student_name, :student_roll_no, :student_dob, :student_class_id)
				";

				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output = array(
						'success'		=>	'Data Added Successfully',
					);
				}
			}
			if($_POST["action"] == "Edit")
			{
				$data = array(
					':student_name'			=>	$student_name,	
					':student_roll_no'	=>	$student_roll_no,
					':student_dob'			=>	$student_dob,
					':student_class_id'		=>	$student_class_id,
					':student_id'			=>	$_POST["student_id"]
				);
				$query = "
				UPDATE student_tbl 
				SET student_name = :student_name, 
				student_roll_no = :student_roll_no, 
				student_dob = :student_dob, 
				student_class_id = :student_class_id 
				WHERE student_id = :student_id
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output = array(
						'success'		=>	'Data Edited Successfully',
					);
				}
			}
		}
		echo json_encode($output);
	}

	if($_POST["action"] == "edit_fetch")
	{
		$query = "
		SELECT * FROM student_tbl 
		WHERE student_id = '".$_POST["student_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$output["student_name"] = $row["student_name"];
				$output["student_roll_no"] = $row["student_roll_no"];
				$output["student_dob"] = $row["student_dob"];
				$output["student_class_id"] = $row["student_class_id"];
				$output["student_id"] = $row["student_id"];
			}
			echo json_encode($output);
		}
	}
	if($_POST["action"] == "delete")
	{
		$query = "
		DELETE FROM student_tbl 
		WHERE student_id = '".$_POST["student_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			echo 'Data Delete Successfully';
		}
	}
}

?>