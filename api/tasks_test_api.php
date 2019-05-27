<?php

//tasks_test_api.php

include('tasks_Api.php');

$api_object = new API();

if($_GET["action"] == 'fetch_all')
{
	$data = $api_object->fetch_all($_GET["user_id"]);
}

if($_GET["action"] == 'insert')
{
	$data = $api_object->insert($_POST["user_id"]);
}

if($_GET["action"] == 'fetch_single')
{
	$data = $api_object->fetch_single($_GET["id"]);
}

if($_GET["action"] == 'update')
{
	$data = $api_object->update();
}

if($_GET["action"] == 'delete')
{
	$data = $api_object->delete($_GET["id"]);
}

echo json_encode($data);

?>