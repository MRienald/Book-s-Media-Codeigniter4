<div class="modal fade" tabindex="-1" id="modal-book">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Book data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr><center></center>
                            <th><center>NO</center></th>
                            <th><center>Cover</center></th>
                            <th><center>Title</center></th>
                            <th><center>Catagory</center></th>
                            <th><center>Release Year</center></th>
                            <th><center>Price</center></th>
                            <th><center>Stock</center></th>
                            <th><center>Action</center></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        <?php foreach($data_buku as $value): ?>
                            <tr>
                                <td><center><?= $no++ ?></center></td>
                                <td>
                                    <img src="/img/<?=$value['cover']?>" alt="" width="100px">
                                </td>
                                <td><?=$value['title']?></td>
                                <td><?=$value['name_catagory']?></td>
                                <td><center><?=$value['release_year']?></center></td>
                                <td><center><?= number_to_currency($value['price'], 'IDR', 'id_ID', 2) ?></center></td>
                                <td><center><?=$value['stock']?></center></td>
                                <td>
                                    <center><button class="btn btn-primary m-4" onclick="add_to_cart('<?= $value['book_id'] ?>', '<?= $value['title'] ?>', '<?= $value['price'] ?>', '<?= $value['discount'] ?>')"><i class="fas fa-plus-circle"></i>&nbsp&nbspSelect</button></center>
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

<!-- Modal Update cart -->
<div class="modal fade" tabindex="-1" id="modal-update-book">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Jumlah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="rowid">
        <input type="number" class="form-control" id="qty">
      </div>
      <div class="modal-footer">
        <button type="button" onclick="update_to_cart()" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--                    -->

<script>
    function add_to_cart(id, judul, harga, diskon){
        $.ajax({
            url: "/add-cart-jual",
            method: "post",
            data: {
                'id_buku' : id,
                'judul_buku' : judul,
                'harga_buku' : harga,
                'diskon' : diskon
            },
            success: function(data){
                load()
            }
        });
    }

    function update_to_cart(){
        var rowid = $('#rowid').val()
        var qty = $('#qty').val()
        $.ajax({
            url: "/edit-cart-jual/" + rowid,
            method: "post",
            data: {
                'jumlah' : qty,
            },
            success: function(data){
                load()
                $('#modal-update-book').modal('hide');
            }
        });
    }
</script>