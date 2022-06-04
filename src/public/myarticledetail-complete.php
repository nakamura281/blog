<?php
include __DIR__ . ('/sqlDelete.php');
include __DIR__ . ('/action.php');
$id = filter_input(INPUT_POST, "id");
$obj = new Delete();
$sql = "DELETE FROM blogs WHERE id = :id";
$stmt = $obj->delete($sql , $id);

$request = new Action;
$action = $request->redirect('mypage.php');
?>