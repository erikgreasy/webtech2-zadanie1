<form action="#" enctype="multipart/form-data" method="POST">

    <?php include_once 'upload-form-errors.php' ?>

    <div class="form-group">
        <label for="name">
            Názov súboru:
            <input type="text" name="name" id="name" class="form-control" required>
        </label>
    </div>

    <div class="form-group">
        <label for="file">
            <input type="file" name="file" id="file" required>
        </label>
    </div>

    <input type="submit" value="Nahrať" class="btn btn-info">
</form>