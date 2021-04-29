<h2 class="student">user List</h2>
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
      <th>Name</th>
      <th>Phone</th>
      <th style="width: 3.5em;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
    foreach ($userdata as $sdata) {
      $i++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $sdata->username; ?></td>
        <td><?php echo $sdata->phone; ?></td>
        <td>
          <a href="<?php echo base_url("user/viewUser/$sdata->username"); ?>"><i class="fas fa-info-circle"></i></a>
          <a href="<?php echo base_url("user/editUser/$sdata->user_id"); ?>"><i class=" fa fa-pencil"></i></a>
          <a onclick="return confirm('Are you sure to remove ?'); " href="<?php echo base_url("user/delUser/$sdata->user_id"); ?>" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>