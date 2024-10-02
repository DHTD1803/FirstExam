<div class="container">
    <div class="float-right pb-3 pt-3">
        <a href="<?php echo site_url('item/create') ?>" class="btn btn-info">Add new</a>
    </div>
    <table class="table">
        <thead>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            $html = '';
            foreach ($table_data as $data) {
                $action_button = '<a onClick="viewDetail(this)" class="btn btn-primary show mx-2">Show</a>'
                    . '<a onClick="editItem(this)" class="btn btn-success edit mx-2">Edit</a>'
                    . '<a type="button" class="btn btn-danger remove mx-2">Delete</a>';
                $html .= "<tr data-item_id='" . $data["id"] . "' data-item_title='" . $data["title"] . "' data-item_description='" . $data["description"] . "'>";
                $html .= "<td>" . $data["title"] . "</td> <td>" . $data["description"] . "</td>";
                $html .= "<td>" . trim($action_button) . "</td>";
                $html .= "</tr>";
            }
            echo $html;
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('item/create_or_update', ['id' => 'form-submit']); ?>

            <div class="modal-body">
                <input type="text" name="id" class="form-control" hidden>
                <div class="form-group">
                    <label for="exampleInputEmail1">Title <span class="text-danger">*</span> </label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description <span class="text-danger">*</span> </label>
                    <textarea class="form-control" name="description" style="min-height: 120px;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submit-update">Update</button>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        <?php if ($this->session->flashdata('success')) { ?>
            iziToast.success({
                title: '<?php echo $this->session->flashdata('success'); ?>',
            });
        <?php } elseif ($this->session->flashdata('warning')) { ?>
            iziToast.warning({
                title: '<?php echo $this->session->flashdata('warning'); ?>',
            });
        <?php } ?>

        $('.remove').on('click', function() {
            let item_id = $(this).closest('tr').data('item_id');
            $.ajax({
                url: "<?php echo site_url('item/remove') ?>",
                type: "POST",
                data: {
                    'id': item_id,
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status) {
                        iziToast.success({
                            title: response.msg,
                        });
                    } else {
                        iziToast.warning({
                            title: response.msg,
                        });
                    }

                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred: " + error);
                }
            })
        })
    }

    function viewDetail(param) {
        let item_id = $(param).closest('tr').data('item_id');
        let item_title = $(param).closest('tr').data('item_title');
        let item_description = $(param).closest('tr').data('item_description');

        $('#itemModal').modal('show');
        $('#itemModalLabel').html('Detail Item');
        $('input[name="id"]').val(item_id);
        $('input[name="title"]').val(item_title);
        $('textarea[name="description"]').val(item_description);
        $('#submit-update').addClass('d-none');
    }

    function editItem(param) {
        let item_id = $(param).closest('tr').data('item_id');
        let item_title = $(param).closest('tr').data('item_title');
        let item_description = $(param).closest('tr').data('item_description');

        $('#itemModal').modal('show');
        $('#itemModalLabel').html('Edit Item');
        $('input[name="id"]').val(item_id);
        $('input[name="title"]').val(item_title);
        $('textarea[name="description"]').val(item_description);
        $('#submit-update').removeClass('d-none');
    }
</script>