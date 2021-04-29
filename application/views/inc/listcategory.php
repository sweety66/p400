<h2>Category List</h2>
<hr />
<?php
$msg = $this->session->flashdata('msg');
if (isset($msg)) {
  echo $msg;
}
?>
<table class="table category" id="sweety">
  <thead>
    <tr>
      <th>No.</th>
      <th>Name</th>
      <th style="width: 3.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
    foreach ($allcat as $cdata) {
      $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $cdata->cat_name; ?></td>
        <td>
          <?php if ($this->session->userdata("role") === "admin") { ?>
            <a href="<?php echo base_url("category/editCategory/" . $cdata->cat_id); ?>"><i class="fa fa-pencil"></i></a>
            <a onclick="return confirm('Are you sure to remove ?'); " href="<?php echo base_url("category/delCategory/" . $cdata->cat_id); ?>" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>