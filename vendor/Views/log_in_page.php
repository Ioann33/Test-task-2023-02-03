<?php
if (isset($_SESSION['errors'])){
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
?>

<?php
if (isset($_SESSION['message'])){
    $messages = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

    <h1 class="text-center mt-5"><a href="/" style="text-decoration: none; color: #bb4f5f">FictionQuizService</a></h1>
<?php if (!empty($errors)):?>
    <div class="alert-danger text-center" style="width: 300px; margin: 50px auto 0">
        <ul style="list-style: none">
            <?php foreach ($errors as $error):?>
                <li><?=$error?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>
<?php if (!empty($messages)):?>
    <div class="alert alert-info text-center" style="width: 300px; margin: 50px auto 0">
        <ul style="list-style: none">
            <?php foreach ($messages as $message):?>
                <li><?=$message?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0" style="margin-top: 100px">
    <div class="row bg-white shadow-sm">
        <div class="col border rounded p-4">
            <h3 class="text-center mb-4">LogIn</h3>
            <form style="width: 250px" action="/auth/login" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pass" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">Sign in</button>
            </form>
        </div>
    </div>
</div>
