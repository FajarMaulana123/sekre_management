@extends('layout.index')
@section('content')

    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Master Data</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span> Project</span></li>
    </ol>
    <h1 class="page-header">Project</h1>
       
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title" id="title-bom">Data Project</h4>
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
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Harga</th>
                            <th>Status</th>
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
                                                    <input type="text" name="nama_project" id="nama_project" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>       
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Jenis Project</label>
                                                    <select name="id_jenis_project" id="id_jenis_project" class="form-control form-control-sm">
                                                        <option value="">- Pilih Jenis Project -</option>
                                                        @foreach($data['jenis_project'] as $val)
                                                            <option value="{{$val->id}}">{{$val->jenis_project}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Client</label>
                                                    <select name="id_client" id="id_client" class="form-control form-control-sm">
                                                        <option value="">- Pilih Client -</option>
                                                        @foreach($data['client'] as $val)
                                                            <option value="{{$val->id}}">{{$val->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Perusahaan</label>
                                                    <select name="id_perusahaan" id="id_perusahaan" class="form-control form-control-sm">
                                                        <option value="">- Pilih Client -</option>
                                                        @foreach($data['perusahaan'] as $val)
                                                            <option value="{{$val->id}}">{{$val->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Kontrak</label>
                                                    <input type="text" name="durasi_project" id="durasi_project" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="">Tanggal Mulai</label>
                                                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label for="">Tanggal Selesai</label>
                                                    <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Harga</label>
                                                    <input type="number" name="harga" id="harga" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="form-group mb-2">
                                                    <label>Image</label>
                                                    <input type="file" name="image" id="image"  accept="image/*" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div> --}}
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

<div class="modal fade" id="status_" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judul-status" id="status_"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"  aria-label="Close">
                </button>
            </div>
            <form id="status-form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                        <input type="hidden" name="hidden_id" id="hidden_id_status">
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" id="status" class="form-control form-control-sm">
                                                        <option value="OFFERING">Offering</option>
                                                        <option value="INVOICE">Invoice</option>
                                                        <option value="DEALING">Dealing</option>
                                                        <option value="DONE">Done</option>
                                                    </select>
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
                url: '/adm/project_',
                method: 'POST',
                data: function(d){

                }
            },
            columnDefs: [
                { className: 'text-center', targets: [0,9,10] },
           ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'nama_project', name: 'nama_project'},
                {data: 'nama_client', name: 'nama_client'},
                {data: 'nama_perusahaan', name: 'nama_perusahaan'},
                {data: 'jenis_project', name: 'jenis_project'},
                {data: 'durasi_project', name: 'durasi_project'},
                {data: 'tgl_mulai', name: 'tgl_mulai'},
                {data: 'tgl_akhir', name: 'tgl_akhir'},
                {data: 'harga', name: 'harga'},
                {data: 'status', name: 'status'},
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
                        $('.judul-modal').text('Tambah Project');
                        $('#hidden_status').val('add');
                    }
                },
                {
                    extend: 'excel',
                    title: 'Data Project',
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
            $('.judul-modal').text('Edit Project');
            $('#hidden_status').val('edit');
            $('#hidden_id').val($(this).data('id'));
            $('#nama_project').val($(this).data('nama_project'));
            $('#durasi_project').val($(this).data('durasi_project'));
            $('#id_client').val($(this).data('id_client'));
            $('#id_perusahaan').val($(this).data('id_perusahaan'));
            $('#id_jenis_project').val($(this).data('id_jenis_project'));
            $('#tgl_mulai').val($(this).data('tgl_mulai'));
            $('#tgl_akhir').val($(this).data('tgl_akhir'));
            $('#harga').val($(this).data('harga'));
        });

        $(document).on('click', '.status', function() {
            $('#status-form')[0].reset();
            $('#status_').modal('show');
            $('#btn-sb').text('Update');
            $('.judul-status').text('Update Status');
            $('#hidden_id_status').val($(this).data('id'));
            $('#status').val($(this).data('status'));
        });

       
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/adm/delete_project",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            table.ajax.reload();
                            Swal.fire({
                                title: data.title,
                                text:  data.status,
                                icon: data.icon,
                                timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: false,
                                buttons: false,
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error');
                        }
                    });
                }
            })
        });

        $("#add-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
                nama_project: {
                    required: true
                },
                id_jenis_project: {
                    required: true
                },
                id_client: {
                    required: true
                },
                harga: {
                    required: true
                },
            },
            submitHandler: function(form) {
                let url;
                if ($('#hidden_status').val() == 'add') {
                    url = '/adm/create_project';
                } else {
                    url = '/adm/update_project';
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
                                text: "Gagal Tambah / Update Project",
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

        $("#status-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
               
            },
            submitHandler: function(form) {
                var datas = new FormData(document.getElementById("status-form"));
                // console.log(datas);
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Update!',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    // console.log(datas);
                    if (result.value) {
                        $.ajax({
                            url: '/adm/update_status_project',
                            type: "POST",
                            data: datas,
                            dataType: "JSON",
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                $('#status_').modal('hide');
                                table.ajax.reload();
                                Swal.fire({
                                    title: data.title,
                                    text:  data.status,
                                    icon: data.icon,
                                    timer: 3000,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    buttons: false,
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error');
                            }
                        });
                    }
                }) 
            }
        });
    });
</script>
@endsection