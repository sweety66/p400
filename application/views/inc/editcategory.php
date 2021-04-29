<h2>Edit Category</h2>
<hr />
<?php
$msg = $this->session->flashdata('msg');
if (isset($msg)) {
    echo $msg;
}
?>
<div class="panel-body" style="width:600px;">
    <form action="<?php echo base_url("category/updateCategory/"); ?>" method="post">
        <input type="hidden" name="cat_id" value="<?php echo $categoryById->cat_id; ?>">
        <div class="form-group">
            <label>Update Category Name</label>
            <input type="text" name="cat_name" value="<?php echo $categoryById->cat_name; ?>" class="form-control span12">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>

    </form>
</div>