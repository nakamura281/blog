<?php
include __DIR__ . ('/function.php');
$id = filter_input(INPUT_POST, "id");
$obj = new sql_connect();
$sql = "DELETE FROM blogs WHERE id = :id";
$stmt = $obj->delete($sql , $id);

$request = new action;
$action = $request->redirect('mypage.php');
?>