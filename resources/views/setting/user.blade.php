@extends('layout.index')
@section('content')

    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item " aria-current="page"><span>Setting</span></li>
        <li class="breadcrumb-item active" aria-current="page"><span>User Management</span></li>
    </ol>
    <h1 class="page-header">User Management</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Data User Management</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                
            </div>
        </div>      
        <div class="panel-body">
            <div class="table-responsive mb-2">
                <table id="table" class="table table-striped table-bordered align-middle" width="100%">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username Code</th>
                        <th>Email By</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th>Locked</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judul-modal" id="Modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                            <input type="hidden" name="hidden_status" id="hidden_status" value="add">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            User Account
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" name="nama" id="nama" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" name="username" id="username" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group">
                                                        <label>E-mail</label>
                                                        <input type="email" name="email" id="email" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                
                                            </div>                                        
                                            <div class="row"> 
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="password" id="password" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Retype Password</label>
                                                        <input type="password" name="repassword" id="repassword" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select name="role" id="role" class="form-select form-control-sm">
                                                            <option value="">- Pilih Role -</option>
                                                            <option value="SUPER_ADMIN">Super Admin</option>
                                                            <option value="ADMIN">Admin</option>
                                                            {{-- <option value="management">Management</option> --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                        <label>Permissions</label>
                                        <div class="row row-cols-2">
                                        <?php $no = 1;
                                        foreach (groupModul() as $gm) : ?>
                                            <div class="col mb-2">
                                                <div class="card">
                                                    <div class="card-header d-flex">
                                                        <div class="flex-fill">
                                                            <div class="form-check">
                                                                <input class="form-check-input all-<?= $no ?> check-all-submodul" data-no="<?= $no; ?>" type="checkbox" value="<?= str_replace(' ', '_', $gm->group); ?>" id="<?= $no; ?>" />
                                                                <label class="form-check-label" for="<?= $no; ?>"><?= $gm->group; ?></label>
                                                            </div>
                                                        </div>
                                                        <a data-bs-toggle="collapse" data-bs-target="#collapse<?= $gm->group; ?>" aria-expanded="false" class="text-primary dropdown-toggle" role="button"  aria-controls="collapse<?= $gm->group; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                        </a>
                                                    </div>
                                                    <div class="card-body submodul-<?= $no ?> collapse submenu list-unstyled" id="collapse<?= $gm->group; ?>" data-parent="#collapse<?= $gm->group; ?>">
                                                        <?php foreach (subModul($gm->group) as $sm) : ?>
                                                            <div class="form-check">
                                                                <input name="permission[]" class="form-check-input sub-<?= $no ?> checkbox-submodul" data-no_all="<?= $no; ?>" data-id="<?= $sm->id_modul ?>" type="checkbox" value="<?= $sm->id_modul ?>" id="<?= $sm->id_modul; ?>" />
                                                                <label class="form-check-label" for="<?= $sm->id_modul; ?>"><?= $sm->nama; ?></label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php $no++;
                                        endforeach; ?>
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
            ajax: {
                url: '/usermanagemant_',
                method: 'POST',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'roles', name: 'roles'},
                {data: 'lastLogin', name: 'lastLogin'},
                {
                    data: 'islocked', 
                    name: 'islocked', 
                    orderable: false, 
                    searchable: false
                },
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
                        $('.judul-modal').text('Tambah User Management');
                        $('#hidden_status').val('add');
                    }
                },
               
                {
                    extend: 'excel',
                    title: 'User management',
                    className: 'dt-buttons btn-group flex-wrap',
                    text: '<i class="far fa-file-code"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                       
               
                ]
        });

        $('body').on('click', '.check-all-submodul', function() {
            var no = $(this).data('no');
            var submodul = '.submodul-' + no;
            $(submodul + " input[type='checkbox']").not(this).prop('checked', this.checked);
        });

        $('body').on('click', '.checkbox-submodul', function() {
            var no = $(this).data('no_all');
            if ($('.sub-' + no + ':checked').length == $('.sub-' + no).length) {
                $('.all-' + no).prop('checked', true);
            } else {
                $('.all-' + no).prop('checked', false);
            }
        });

        $(document).on('click', '.edit', function() {
            // $('#modul-form')[0].reset();
            $("#add-form").trigger("reset");
            var id = $(this).data('id');
            $('#add-form')[0].reset();
            $('#Modal').modal('show');
            $('#btn-sb').text('Edit');
            $('.judul-modal').text('Edit User Management');
            $("#hidden_id").val(id);
            $("#nama").val($(this).data('nama'));
            $("#username").val($(this).data('username'));
            $("#email").val($(this).data('email'));
            $("#role").val($(this).data('role'));
            $("#hidden_status").val("edit");
            $.ajax({
                url: '/get_modul',
                type: "POST",
                data: {
                    'id': $(this).data('id'),
                },
                success: function(res) {
                    var data = JSON.parse(res)
                    var data_modul = data.data_modul;
                    for (var i = 0; i < data_modul.length; i++) {
                        $("input[name='permission[]']").each(function() {
                            if ($(this).val() === data_modul[i].id_modul) {
                                $(this).prop("checked", true);
                            }
                        });
                    }
                    $('.checkbox-submodul').each(function(index, obj) {
                        var no = $(this).data('no_all');
                        if ($('.sub-' + no + ':checked').length == $('.sub-' + no).length) {
                            $('.all-' + no).prop('checked', true);
                        } else {
                            $('.all-' + no).prop('checked', false);
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        });

        $("#add-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
                nama: {
                    required: true
                },
                username: {
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    required: function() {
                        if ($('#hidden_status').val() == 'edit') {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    minlength: 6
                },
                repassword: {
                    required: function() {
                        if ($('#hidden_status').val() == 'edit') {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    minlength: 6,
                    equalTo: "#password",
                },
                // toko: {
                //     required: true,
                // },
                role: {
                    required: true,
                },

            },
            submitHandler: function(form) {
                let url;
                if ($('#hidden_status').val() == 'add') {
                    url = '/create_usermanagement';
                } else {
                    url = '/update_usermanagement';
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    data: new FormData(document.getElementById("add-form")),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data.result != true) {
                            Swal.fire({
                                title: 'Gagal',
                                text: "Gagal Tambah / Update User",
                                icon: 'error',
                                // timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                            table.ajax.reload();
                        } else {
                            Swal.fire({
                                title: 'Berhasil',
                                icon: 'success',
                                // timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
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
                        url: "/delete_user",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            table.ajax.reload();
                            Swal.fire({
                                title: data.title,
                                text: data.status,
                                icon: data.icon,
                                // timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error');
                        }
                    });
                }
            })
        });

        $(document).on('click', '.locked', function(){
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/locked_user",
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
                                // timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error');
                        }
                    });
                }
            })
        })

       

    });
</script>
@endsection