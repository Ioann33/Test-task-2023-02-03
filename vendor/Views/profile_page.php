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

    <h1 class="text-center mt-5"><a href="/" style="text-decoration: none; color: #bb4f5f">Profile page</a></h1>

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
<nav class="nav flex-row " style="margin: 10px;" >
    <a class="nav-link active btn btn-success mb-2 mr" style="width: 170px; height: 37px" aria-current="page" href="<?=Route::url('question', 'create')?>"> + Create question</a>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle mr" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Sort by question
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="<?=Route::url('index', 'profile', 'action?qustions=asc')?>">Asc</a></li>
            <li><a class="dropdown-item" href="<?=Route::url('index', 'profile', 'action?qustions=desc')?>">Desc</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle mr" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            Sort by date
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            <li><a class="dropdown-item" href="<?=Route::url('index', 'profile', 'action?date=asc')?>">Asc</a></li>
            <li><a class="dropdown-item" href="<?=Route::url('index', 'profile', 'action?date=desc')?>">Desc</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle mr" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
            Sort by status
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
            <li><a class="dropdown-item" href="<?=Route::url('index', 'profile', 'action?published=1')?>">published</a></li>
            <li><a class="dropdown-item" href="<?=Route::url('index', 'profile', 'action?published=0')?>">private</a></li>
        </ul>
    </div>
    <a class="nav-link active btn btn-primary mb-2 mr" style="width: 170px; height: 37px; color: aliceblue" aria-current="page" href="<?=Route::url('index', 'profile')?>"> Clear </a>
</nav>
<div class="box">
    <?php if(isset($questions)): ?>
        <?php foreach ($questions as $key => $question):?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/images/quest.jpeg" class="img-fluid rounded-start" alt="img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$question['text']?></h5>
                            <ul class="list-group list-group-flush">
                                <?php if(isset($question['answers'])): ?>
                                    <?php foreach ($question['answers'] as $key2 => $item):?>
                                        <li class="list-group-item list-style"><span><?=$item['answer']?></span><span><?=$item['voices']?></span></li>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </ul>
                            <div class="card-body">
                                <a href="<?=Route::url('question', 'edit', 'action?quest_id='.$key)?>" class="btn btn-primary">Edit</a>
                                <a href="<?=Route::url('question', 'delete', 'action?quest_id='.$key)?>" class="btn btn-danger">Delete</a>
                            </div>
                            <p class="card-text" style="float: right;margin: 5px"><small class="text-muted"><?=$question['date']?></small></p>
                            <p class="card-text" style="float: right;margin: 5px"><small class="text-muted"><?php if ($question['published'] === 1) echo 'public'; else echo 'private';?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>
