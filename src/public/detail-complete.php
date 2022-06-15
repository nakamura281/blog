<?php 
include __DIR__ . ('/../app/Lib/SqlInsert.php');
include __DIR__ . ('/../app/Lib/Action.php');

$commenter_name = filter_input(INPUT_POST, "commenter_name");
$comments = filter_input(INPUT_POST, "comments");
$blog_id = filter_input(INPUT_POST, "id");
$user_id = filter_input(INPUT_POST, "user_id");

$obj = new SqlInsert();
$sql = "INSERT INTO comments (
    user_id , blog_id , commenter_name , comments , created_at , updated_at	
    ) VALUES (
    :user_id , :blog_id , :commenter_name , :comments , now() , now()
)";
$stmt = $obj->insert1($sql , $user_id , $blog_id , $commenter_name , $comments);
//リダイレクト
$request = new Action;
$action = $request->redirect('detail.php');
?>