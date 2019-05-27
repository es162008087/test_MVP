<?php

//tasks_Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=u759069244_demo", "u759069244_demo", "ygaZymeDar");
	}

	function fetch_all($user_id)
	{
		$query = "SELECT * FROM `tasks` AS t, states as s WHERE t.state_id = s.id AND t.user_id = ".$user_id." ORDER BY t.id  ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["description"]))
		{
			$form_data = array(
				':user_id'		=>	$_POST["user_id"],
				':description'		=>	$_POST["description"],
				':state_id'		=>	$_POST["state_id"],
			);
			$query = "
			INSERT INTO tasks 
			(description, state_id, user_id) VALUES 
			(:description, :state_id, :user_id)
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM tasks WHERE id='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['description'] = $row['description'];
				$data['state'] = $row['state'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["description"]))
		{
			$form_data = array(
				':description'	=>	$_POST['description'],
				':state'	=>	$_POST['state'],
				':id'			=>	$_POST['id']
			);
			$query = "
			UPDATE tasks 
			SET description = :description,
			state = :state 
			WHERE id = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM tasks WHERE id = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>