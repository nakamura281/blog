<?php
include __DIR__ . ('/SqlDelete.php');
include __DIR__ . ('/Action.php');
$id = filter_input(INPUT_POST, "id");
$obj = new SqlDelete();
$sql = "DELETE FROM blogs WHERE id = :id";
$stmt = $obj->delete($sql , $id);

$request = new Action;
$action = $request->redirect('mypage.php');
?>