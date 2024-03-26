@extends('layout.index')
@section('content')
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item " aria-current="page"><span>CMS</span></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Profile</span></li>
    </ol>
    <h1 class="page-header">Profile</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Data Profile</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                
            </div>
        </div>      
        <div class="panel-body">
            <form id="add-form">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->nama}}" >
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>No Tlp</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->no_hp}}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fax</label>
                            <input type="text" id="fax" name="fax" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->fax}}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>No WA</label>
                            <input type="text" id="wa" name="wa" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->wa}}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->email}}" >
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Link Facebook</label>
                            <input type="text" id="facebook" name="facebook" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->facebook}}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Link Instagram</label>
                            <input type="text" id="ig" name="ig" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->ig}}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Link LinkedIn</label>
                            <input type="text" id="linkedin" name="linkedin" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->linkedin}}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Link Youtube</label>
                            <input type="text" id="yt" name="yt" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->yt}}" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control">{{($data['data'] == null) ? '' : $data['data']->alamat}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row mb-2">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input type="text" name="lat" id="lat" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->lat}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input type="text" name="long" id="long" class="form-control" value="{{($data['data'] == null) ? '' : $data['data']->long}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-3">
                        <div class="row mb-2">
                            <div class="form-group">
                                <label>Upload Logo</label>
                                <input type="file" name="foto" id="foto"  accept="image/*" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <img id="imgPreview" src="#" alt="logo" style="width:-webkit-fill-available" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tentang Kami</label>
                            <textarea name="tentang_kami" id="tentang_kami" cols="30" rows="10" class="form-control form-control-sm tentang_kami">{{($data['data'] == null) ? '' : $data['data']->tentang_kami}}"</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div style="align-items: right">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form>
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

        $(".tentang_kami").summernote({
            height: "300"
        });

         var image_ = "{{($data['data'] != null) ? asset($data['data']->logo) : asset('/uploads/noimage.jpg')}}";
         $("#imgPreview").attr("src", image_);

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
     
        $("#add-form").validate({
            errorClass: "is-invalid",
            // validClass: "is-valid",
            rules: {
                nama: {
                    required: true
                },
                no_hp: {
                    required: true
                },
                fax: {
                    required: true
                },
                wa: {
                    required: true
                },
                email: {
                    required: true
                },
                facebook: {
                    required: true
                },
                ig: {
                    required: true
                },
                linkedin: {
                    required: true
                },
                yt: {
                    required: true
                },
                alamat: {
                    required: true
                },
                lat: {
                    required: true
                },
                long: {
                    required: true
                },
                tentang_kami: {
                    required: true
                }
            },
            submitHandler: function(form) {
                let url;
                url = '/adm/create_profile';

                var form_data = new FormData(document.getElementById("add-form"));

                $.ajax({
                    url: url,
                    type: "POST",
                    data: form_data,
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
                                text: "Gagal Update Profile",
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: true,
                                // buttons: false,
                            });
                        } else {
                            Swal.fire({
                                title: 'Berhasil',
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });

        // $(document).on('click', '#filter', function(){
        //     table.ajax.reload();
        // })

    });
</script>
@endsection