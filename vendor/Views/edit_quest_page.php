<script src="/js/editFormHandler.js" defer></script>
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0" style="margin-top: 100px">
    <div class="row bg-white shadow-sm">
        <div class="col border rounded p-4">
            <h3 class="text-center mb-4">Edit question</h3>
            <form style="width: 800px" action="/question/save" method="post">
                <input type="hidden" class="quest-id" value="<?php if (isset($id)) echo $id?>">
                <div class="edit-form">

                </div>
                <button type="button" class="btn btn-success m-2 adda" style="float: right">+ Add answer</button>
                <button type="submit" class="btn btn-primary w-25 mt-2 update-btn">Update</button>
            </form>
        </div>
    </div>
</div>
