<?php

//semester_action.php

include('database_connection.php');

session_start();

$output = '';

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "SELECT * FROM class_tbl ";
		if(isset($_POST["search"]["value"]))
		{
			$query .= 'WHERE class_name LIKE "%'.$_POST["search"]["value"].'%" ';
		}
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= 'ORDER BY class_id DESC ';
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
			$sub_array[] = $row["class_name"];
			$sub_array[] = '<button type="button" name="edit_class" class="btn btn-primary btn-sm edit_class" id="'.$row["class_id"].'">Edit</button>';
			$sub_array[] = '<button type="button" name="delete_class" class="btn btn-danger btn-sm delete_class" id="'.$row["class_id"].'">Delete</button>';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"			=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'class_tbl'),
			"data"				=>	$data
		);

		
	}
	if($_POST["action"] == 'Add' || $_POST["action"] == "Edit")
	{
		$class_name = '';
		$error_class_name = '';
		$error = 0;
		if(empty($_POST["class_name"]))
		{
			$error_class_name = 'Semester Name is required';
			$error++;
		}
		else
		{
			$class_name = $_POST["class_name"];
		}
		if($error > 0)
		{
			$output = array(
				'error'							=>	true,
				'error_class_name'				=>	$error_class_name
			);
		}
		else
		{
			if($_POST["action"] == "Add")
			{
				$data = array(
					':class_name'				=>	$class_name
				);
				$query = "
				INSERT INTO class_tbl 
				(class_name) 
				SELECT * FROM (SELECT :class_name) as temp 
				WHERE NOT EXISTS (
					SELECT class_name FROM class_tbl WHERE class_name = :class_name
				) LIMIT 1
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					if($statement->rowCount() > 0)
					{
						$output = array(
							'success'		=>	'Data Added Successfully',
						);
					}
					else
					{
						$output = array(
							'error'					=>	true,
							'error_class_name'		=>	'Semester Name Already Exists'
						);
					}
				}
			}
			if($_POST["action"] == "Edit")
			{
				$data = array(
					':class_name'			=>	$class_name,
					':class_id'				=>	$_POST["class_id"]
				);

				$query = "
				UPDATE class_tbl 
				SET class_name = :class_name 
				WHERE class_id = :class_id
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output = array(
						'success'		=>	'Data Updated Successfully',
					);
				}
			}
		}
	}

	if($_POST["action"] == "edit_fetch")
	{
		$query = "
		SELECT * FROM class_tbl WHERE class_id = '".$_POST["class_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$output["class_name"] = $row["class_name"];
				$output["class_id"] = $row["class_id"];
			}
		}
	}

	if($_POST["action"] == "delete")
	{
		$query = "
		DELETE FROM class_tbl 
		WHERE class_id = '".$_POST["class_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			echo 'Data Deleted Successfully';
		}
	}

	echo json_encode($output);
}

?>