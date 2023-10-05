<?php
// Start the session
session_start();

require_once 'models/UserModel.php';
$userModel = new UserModel();
//----------
if(!empty($_GET['loi'])){
    echo '<div class="al" style ="
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgb(0 0 0 / 70%);
    width: 100%;
    display: flex;
    color: #fff;
    z-index: 9999;
    height: 100%;
    text-align: center;
    justify-content: center;
    align-items: center;
    flex-direction: column;

    ">
        <div> Đã có người chỉnh sửa </div>
        <button style="width: 100px;
        text-align: center;
        padding: 10px;
        margin-top: 30px;" class="alr btn btn-primary">OK</button>
    </div>';
    echo '<script>window.history.pushState({}, "New Page Title", "/CloneW1/training-php/list_users.php");
            const alr = document.querySelector(".alr")
            const al = document.querySelector(".al")
            alr.addEventListener("click", ()=>{
                al.style.display = "none"
            })
        </script>';
}
//----------
$params = [];
if (!empty($_GET['keyword'])) {
    $params['keyword'] = $_GET['keyword'];
}

$users = $userModel->getUsers($params);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self'https://apis.google.com">
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php'?>
    <div class="container">
        <?php if (!empty($users)) {?>
            <div class="alert alert-warning" role="alert">
                List of users! <br>
                Hacker: http://php.local/list_users.php?keyword=ASDF%25%22%3BTRUNCATE+banks%3B%23%23
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) {?>
                        <tr>
                            <th scope="row"><?php echo $user['id']?></th>
                            <td>
                                <!-- <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8')?> -->
                                <?php echo strip_tags($user['name'])?>
                            </td>
                            <td>
                                <?php echo strip_tags($user['fullname'])?>
                            </td>
                            <td>
                                <?php echo strip_tags($user['type'])?>
                            </td>
                            <td>
                                <a href="form_user.php?id=<?php echo $user['id'] ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <a href="view_user.php?id=<?php echo $user['id'] ?>">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>
                                <a href="delete_user.php?id=<?php echo $user['id'] ?>">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }else { ?>
            <div class="alert alert-dark" role="alert">
                This is a dark alert—check it out!
            </div>
        <?php } ?>
    </div>
</body>
</html>