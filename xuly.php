<?php
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();
$user = NULL;
$_id = NULL;
$time_update = date('Y-m-d H:i:s');

if (!empty($_POST['submit'])) {

    // $userModel->refresh();
    if (!empty($_POST['id'])){
        $userID2 = $userModel->findUserById($_POST['id']);
        if ($userID2[0]['click_update'] == $userID2[0]['update_at']){
            header('location: list_users.php?loi="loi"');
        }else{
            $_POST['click_update'] = date("Y-m-d H:i:s");

            $userModel->updateUser($_POST);
            header('location: list_users.php');
        }
        die();
    }else{
        $userModel->insertUser($_POST);
        header('location: list_users.php');
    }
}
?>