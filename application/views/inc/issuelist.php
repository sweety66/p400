<h2>Issue List</h2>
<hr />
<?php
$msg = $this->session->flashdata('msg');
if (isset($msg)) {
  echo $msg;
}
?>
<table class="display" id="sweety">
  <thead>
    <tr>
      <th>No.</th>
      <th>User Name</th>
      <th>Book Name</th>
      <th>Borrow Date</th>
      <th>Return Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
    foreach ($issuedata as $idata) {
      $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $idata->username; ?></td>
        <td>
          <?php echo $idata->book_name; ?>

        </td>
        <td><?php echo date("d/m/Y h:ia", strtotime($idata->borrow_date)); ?></td>
        <td><?php echo date("d/m/Y h:ia", strtotime($idata->return_date)); ?></td>

        <td>
          <a onclick="return confirm('Are you sure to remove ?'); " href="<?php echo base_url("issue/dellist/$idata->issue_id"); ?>" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
          <a href="<?php echo base_url("issue/viewUser/$idata->user_id"); ?>" role="button" data-toggle="modal"><i class="fa fa-eye"></i></a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  $(document).ready(function() {
    $("#sweety").DataTable();
  });
</script>