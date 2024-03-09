@extends('layout.index')
@section('content')

    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Team</span></li>
    </ol>
    <h1 class="page-header">Team</h1>
       
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title" id="title-bom">Data Team</h4>
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
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Instagram</th>
                            <th>Facebook</th>
                            <th>LinkedIn</th>
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
                                                    <label for="">Nama</label>
                                                    <input type="text" name="nama" id="nama" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Jabatan</label>
                                                    <input type="text" name="jabatan" id="jabatan" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Instagram</label>
                                                    <input type="text" name="ig" id="ig" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">Facebook</label>
                                                    <input type="text" name="fb" id="fb" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="">LinkedIn</label>
                                                    <input type="text" name="linkedin" id="linkedin" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row mb-2">
                                                <div class="form-group">
                                                    <label>Upload Foto</label>
                                                    <input type="file" name="foto" id="foto"  accept="image/*" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <img id="imgPreview" src="#" alt="foto" style="width:-webkit-fill-available" />
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

        

        $("#foto").change(function () {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#imgPreview")
                        .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
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
                url: '/adm/team_',
                method: 'POST',
                data: function(d){

                }
            },
            columnDefs: [
                // { className: 'text-center', targets: [4,5] },
           ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'foto', name: 'foto'},
                {data: 'nama', name: 'nama'},
                {data: 'jabatan', name: 'jabatan'},
                {data: 'ig', name: 'ig'},
                {data: 'fb', name: 'fb'},
                {data: 'linkedin', name: 'linkedin'},
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
                        $('.judul-modal').text('Tambah Team');
                        $('#hidden_status').val('add');
                        $("#imgPreview").attr("src", "#");
                    }
                },
               
                {
                    extend: 'excel',
                    title: 'Data Team',
                    className: 'btn',
                    text: '<i class="far fa-file-code"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                       
               
                ]
          
        });
        // table.button( 0 ).nodes().css('height', '35px')

        $(document).on('click', '.edit', function() {
            $('#add-form')[0].reset();
            $('#Modal').modal('show');
            $('#btn-sb').text('Update');
            $('.judul-modal').text('Edit Team');
            $('#hidden_status').val('edit');
            $('#hidden_id').val($(this).data('id'));
            $('#nama').val($(this).data('nama'));
            $('#jabatan').val($(this).data('jabatan'));
            $('#ig').val($(this).data('ig'));
            $('#fb').val($(this).data('fb'));
            $('#linkedin').val($(this).data('linkedin'));
            var image_ = $(this).data('foto');
            $("#imgPreview").attr("src", image_);
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
                        url: "/adm/delete_team",
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
                                type: data.icon,
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
                nama: {
                    required: true
                },
                jabatan: {
                    required: true
                },
                ig: {
                    required: true
                },
                fb: {
                    required: true
                },
                linkedin: {
                    required: true
                },
                // foto: {
                //     required: true
                // },
                
            },
            submitHandler: function(form) {
                let url;
                if ($('#hidden_status').val() == 'add') {
                    url = '/adm/create_team';
                } else {
                    url = '/adm/update_team';
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
                                text: "Gagal Tambah / Update Team",
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