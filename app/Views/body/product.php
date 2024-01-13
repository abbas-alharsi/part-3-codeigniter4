

    <div class="container">
        <div class="row mt-5">
            <div class="col-3">
                <form action="<?php echo base_url();?>insert-data" method="post" id="formInsert">
                    <input type="text" name="product" placeholder="product" class="form-control mb-2">
                    <input type="text" name="category" placeholder="category" class="form-control mb-2">
                    <input type="text" name="qty" placeholder="qty" class="form-control mb-2">
                    <input type="number" name="price" placeholder="price" class="form-control mb-2" id="price">
                    <input type="file" name="image" class="form-control mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-9">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal Input</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Gambar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            <?php foreach($rows as $row): ?>
                                <tr>
                                    <td><?php echo $row->timestamp;?></td>
                                    <td><?php echo $row->product;?></td>
                                    <td><?php echo $row->category;?></td>
                                    <td><?php echo $row->qty;?></td>
                                    <td><?php echo number_format($row->price,0,',','.');?></td>
                                    <td><img class="img-thumbnail" src="<?php echo base_url()?>images/<?php echo $row->image;?>" width="75" height="75"></td>
                                    <td>
                                        <button class="btn btn-sm btn-light border" onclick="showEditModal('<?php echo $row->id;?>')">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="showDeleteModal('<?php echo $row->id;?>')">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        Apakah Anda yakin akan menghapus data ini?
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light border float-end" data-bs-dismiss="modal">Tidak</button>
                        <form action="<?php echo base_url();?>delete-data" method="post" id="formDelete">
                            <input type="hidden" name="deleteId">
                            <button type="submit" class="btn btn-sm btn-danger float-end me-2">Ya hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url();?>edit-data" method="post" id="formEdit">
                        <input type="hidden" name="editId">
                        <input type="text" name="newProduct" placeholder="product" class="form-control mb-2">
                        <input type="text" name="newCategory" placeholder="category" class="form-control mb-2">
                        <input type="text" name="newQty" placeholder="qty" class="form-control mb-2">
                        <input type="text" name="newPrice" placeholder="price" class="form-control mb-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    