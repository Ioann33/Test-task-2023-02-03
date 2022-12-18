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