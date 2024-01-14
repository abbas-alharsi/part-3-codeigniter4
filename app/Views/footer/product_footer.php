
    <script>
        let deleteModal
        let editModal
        let alertModal
        let baseUrl = '<?php echo base_url();?>'
        const numberFormat = (number) => {
            let numFormat = new Intl.NumberFormat('de-DE').format(number)
            return numFormat
        }
        const showDeleteModal = (id) => {
            $('[name="deleteId"]').val(id)
            let options = {
                backdrop: true
            }
            deleteModal = new bootstrap.Modal('#deleteModal',options)
            deleteModal.show()
        }
        const showEditModal = (id) => {
            $.ajax(
                {
                    url: `${baseUrl}getdata/${id}`,
                    dataType: 'json',
                    method: 'get',
                    success: res => {
                        let row = res[0]
                        $('[name="editId"]').val(id)
                        $('[name="newProduct"]').val(row['product'])
                        $('[name="newCategory"]').val(row['category'])
                        $('[name="newQty"]').val(row['qty'])
                        $('[name="newPrice"]').val(row['price'])

                        let options = {
                            backdrop: true
                        }
                        editModal = new bootstrap.Modal('#editModal', options)
                        editModal.show()
                    }
                }
            )
        }
        const showAlertModal = (msg) => {
            $('#alert').html(msg)
            let options = {
                backdrop: true
            }
            alertModal = new bootstrap.Modal('#alertModal', options)
            alertModal.show()
        }
        const mapData = (data) => {
            let tr = ''
            data.map( row => {
                tr+=`<tr>
                        <td><${row['timestamp']}</td>
                        <td>${row['product']}</td>
                        <td>${row['category']}</td>
                        <td>${numberFormat(row['qty'])}</td>
                        <td>${numberFormat(row['price'])}</td>
                        <td><img class="img-fluid" src="${baseUrl}images/${row['image']}" width="75" height="75"></td>
                        <td>
                            <button class="btn btn-sm btn-light border" onclick="showEditModal('${row['id']}')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="showDeleteModal('${row['id']}')">Delete</button>
                        </td>
                    </tr>`
            })
            $('tbody#data').html(tr)
        }
        $('#formInsert').ajaxForm(
            {
                success: res => {
                    let data = JSON.parse(res)
                    if(data.msg == 'error') {
                        showAlertModal(data.err_msg)
                    } else {
                        mapData(data.data)
                    }
                }
            }
        )
        $('#formDelete').ajaxForm(
            {
                success: res => {
                    let data = JSON.parse(res)
                    mapData(data)
                    deleteModal.hide()
                }
            }
        )
        $('#formEdit').ajaxForm(
            {
                success: res => {
                    let data = JSON.parse(res)
                    mapData(data)
                    editModal.hide()
                }
            }
        )
    </script>
</body>
</html>