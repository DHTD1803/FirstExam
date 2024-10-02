<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <div class="text-center">
                <?php echo $header_title; ?>
            </div>
        </div>

        <div class="card-body">
            <?php echo form_open('item/create_or_update', ['id' => 'form-submit']); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Title <span class="text-danger">*</span> </label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description <span class="text-danger">*</span> </label>
                <textarea class="form-control" name="description" style="min-height: 120px;"></textarea>
            </div>
            <a href="<?php echo site_url('item')?>" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-primary">Add New</button>
            <?php echo form_close() ?>
        </div>

    </div>
</div>

<script>
    window.onload = function() {
        $('#form-submit').submit(function(e) {
            let title = $.trim($('input[name="title"]').val());
            let des = $.trim($('textarea[name="description"]').val());
            if (title.length <= 0 || des.length <= 0) {
                e.preventDefault();
                iziToast.warning({
                    position: 'topCenter',
                    displayMode: 2,
                    title: 'Please fill all input text',
                });
            }
        });
    }
</script>