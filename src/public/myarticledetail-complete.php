<?php
include __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Infrastructure\BlogDao;

$id = filter_input(INPUT_POST, "id");
$obj = new BlogDao();
$stmt = $obj->delete($id);

$request = new Action;
$action = $request->redirect('mypage.php');
?>