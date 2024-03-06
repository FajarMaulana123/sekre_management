@extends('layout.index')
@section('content')

    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Keuangan</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span> Transaksi</span></li>
    </ol>
    <h1 class="page-header">Transaksi</h1>
       
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title" id="title-bom">Data Transaksi</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div> 
        <div class="panel-body">
            <div class="table-responsive mb-2">
                <table id="table" class="table small table-striped table-bordered dataTables_wrapper" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Project</th>
                            <th>Client</th>
                            <th>Perusahaan</th>
                            <th>Jenis Project</th>
                            <th>Kontrak</th>
                            <th>Harga</th>
                            <th>Status Project</th>
                            <th>Status Transaksi</th>
                            <th>Bukti TF</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>




<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judul-modal" id="Modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"  aria-label="Close">
                </button>
            </div>
            <form id="add-form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                        <input type="hidden" name="hidden_status" id="hidden_status" value="add">
                                        <input type="hidden" name="hidden_id" id="hidden_id">  
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Project</label>
                                                    <select name="id_project" id="id_project" class="form-control form-control-sm">
                                                        <option value="">- Pilih Project -</option>
                                                        @foreach($data['project'] as $val)
                                                            <option value="{{$val->id}}">{{$val->nama_project}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" id="status" class="form-control form-control-sm">
                                                        <option value="">- Pilih Status -</option>
                                                        <option value="BELUM_LUNAS">Belum Lunas</option>
                                                        <option value="DP">Dp</option>
                                                        <option value="LUNAS">Lunas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row ">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Upload Bukti Transfer</label>
                                                    <input type="file" name="bukti_tf" id="bukti_tf"  accept="image/*" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea name="keterangan" id="keterangan" cols="5" rows="5" class="form-control form-control-sm"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                        <button type="reset" class="btn btn-dark">Reset</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('js')
<script>
    $(document).ready(function() {
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#table').DataTable({
            dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex me-0 me-md-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-md-5"i><"col-md-7"p>>>',
            processing: true,
            serverSide: true,
            // deferLoading: 0,
            // language: {
            //     "emptyTable": "Data tidak ditemukan - Silahkan Filter data Rapat terlebih dahulu !"
            // },
            ajax: {
                url: '/transaksi_',
                method: 'POST',
                data: function(d){

                }
            },
            columnDefs: [
                // { className: 'text-center', targets: [0,9,10] },
           ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'nama_project', name: 'nama_project'},
                {data: 'nama_client', name: 'nama_client'},
                {data: 'nama_perusahaan', name: 'nama_perusahaan'},
                {data: 'jenis_project', name: 'jenis_project'},
                {data: 'durasi_project', name: 'durasi_project'},
                {data: 'harga', name: 'harga'},
                {data: 'status_project', name: 'status_project'},
                {data: 'status_transaksi', name: 'status_transaksi'},
                {data: 'bukti_tf', name: 'bukti_tf'},
                {data: 'keterangan', name: 'keterangan'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            buttons: [{
                    text: '<i class="far fa-edit"></i> New',
                    className: 'btn btn-success',
                    action: function(e, dt, node, config) {
                        $('#add-form')[0].reset();
                        $('#Modal').modal('show');
                        $('#btn-sb').text('Tambah');
                        $('.judul-modal').text('Tambah Transaksi');
                        $('#hidden_status').val('add');
                    }
                },
                {
                    extend: 'excel',
                    title: 'Data Transaksi',
                    className: 'btn',
                    text: '<i class="far fa-file-code"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                }]
          
        });
        // table.button( 0 ).nodes().css('height', '35px')

        $(document).on('click', '.edit', function() {
            $('#add-form')[0].reset();
            $('#Modal').modal('show');
            $('#btn-sb').text('Update');
            $('.judul-modal').text('Edit Transaksi');
            $('#hidden_status').val('edit');
            $('#hidden_id').val($(this).data('id'));
            $('#id_project').val($(this).data('id_project'));
            $('#status').val($(this).data('status'));
        });
       

        $("#add-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
                id_project: {
                    required: true
                },
                status: {
                    required: true
                },
            },
            submitHandler: function(form) {
                let url;
                if ($('#hidden_status').val() == 'add') {
                    url = '/create_transaksi';
                } else {
                    url = '/update_transaksi';
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    data: new FormData(document.getElementById("add-form")),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(){
                            swal.fire({
                                title: 'Harap Tunggu!',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                buttons: false,
                                timer: 2000,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                    success: function(data) {
                        if (data.result != true) {
                            Swal.fire({
                                title: 'Gagal',
                                text: "Gagal Tambah / Update Transaksi",
                                icon: 'error',
                                timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: false,
                                buttons: false,
                            });
                            // table.ajax.reload();
                        } else {
                            Swal.fire({
                                title: 'Berhasil',
                                icon: 'success',
                                timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            $('#Modal').modal('hide');
                            table.ajax.reload();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });

    });
</script>
@endsection