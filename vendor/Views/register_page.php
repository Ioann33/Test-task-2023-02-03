<?php
if (isset($_SESSION['errors'])){
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
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
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0" style="margin-top: 100px">
    <div class="row bg-white shadow-sm">
        <div class="col border rounded p-4">
            <h3 class="text-center mb-4">Register</h3>
            <form style="width: 250px" action="/auth/register" method="post">
                <div class="form-group">
                    <label for="exampleInputUname">Email</label>
                    <input type="email" class="form-control" id="exampleInputUname" aria-describedby="emailHelp" name="email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pass" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password Confirm</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="passConfirm" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">Sign up</button>
            </form>
        </div>
    </div>
</div>
