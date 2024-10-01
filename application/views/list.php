<div class="container">
    <div class="float-right pb-3 pt-3">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newItem">Add new</button>
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
                $action_button = '<a type="button" class="btn btn-primary">Show</a> <a type="button" class="btn btn-success">Edit</a> <a type="button" class="btn btn-danger">Delete</a>';
                $html .= "<tr>";
                $html .= "<td>" . $data["title"] . "</td> <td>" . $data["description"] . "</td>";
                $html .= "<td>" . $action_button . "</td>";
                $html .= "</tr>";
            }
            echo $html;
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="newItem" tabindex="-1" aria-labelledby="newItem" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newItem">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('item/create'); ?>
            <div class="modal-body">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" name="Title" class="form-control" aria-label="Sizing example input">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Description</span>
                    </div>
                    <textarea class="form-control" name="description" style="min-height: 120px;"
                        aria-label="With textarea"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add new</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        <?php if ($this->session->flashdata('success')) { ?>
            iziToast.success({
                title: '<?php echo $this->session->flashdata('success'); ?>',
            });
        <?php } elseif ($this->session->flashdata('warning')) {?>
            iziToast.warning({
                title: '<?php echo $this->session->flashdata('warning'); ?>',
            });
        <?php } ?>
    }
</script>