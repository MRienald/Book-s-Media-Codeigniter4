<div class="modal fade" tabindex="-1" id="modal-customer">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Customer data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table id="datatablesSimple2" class="table table-striped">
                    <thead>
                        <tr><center></center>
                            <th><center>NO</center></th>
                            <th><center>Name</center></th>
                            <th><center>No. Customer</center></th>
                            <th><center>Action</center></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        <?php foreach($data_customer as $value): ?>
                            <tr>
                                <td><center><?= $no++ ?></center></td>
                                <td><center><?=$value['name']?></center></td>
                                <td><center><?=$value['no_customer']?></center></td>
                                <td>
                                    <center><button class="btn btn-primary m-4" onclick="getCustomer('<?= $value['customer_id'] ?>', '<?= $value['name'] ?>')"><i class="fas fa-plus-circle"></i>&nbsp&nbspSelect</button></center>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  function getCustomer(id, nama){
    $('#nama-customer').val(nama)
    $('#id-customer').val(id)
    $('#modal-customer').modal('hide')
  }
</script>