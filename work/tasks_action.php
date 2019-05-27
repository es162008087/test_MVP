<?php

//tasks_action.php

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		$form_data = array(
			'description'	=>	$_POST['description'],
			'state'	=>	$_POST['state'],
			'user_id' = $_POST["user_id"],
		);
		$user_id = $_POST["user_id"];
		$api_url = "http://alvarotoriz.esy.es/api/tasks_test_api.php?action=insert&user_id=".$user_id."";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'insert';
			}
			else
			{
				echo 'error';
			}
		}
	}

	if($_POST["action"] == 'fetch_single')
	{
		$id = $_POST["id"];
		$api_url = "http://alvarotoriz.esy.es/api/tasks_test_api.php?action=fetch_single&id=".$id."";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	if($_POST["action"] == 'update')
	{
		$form_data = array(
			'description'	=>	$_POST['description'],
			'state'	=>	$_POST['state'],
			'id'			=>	$_POST['hidden_id']
		);
		$api_url = "http://alvarotoriz.esy.es/api/tasks_test_api.php?action=update";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'update';
			}
			else
			{
				echo 'error';
			}
		}
	}
	if($_POST["action"] == 'delete')
	{
		$id = $_POST['id'];
		$api_url = "http://alvarotoriz.esy.es/api/tasks_test_api.php?action=delete&id=".$id.""; //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>