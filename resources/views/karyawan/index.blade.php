@extends('layouts.app')

@section('title', 'Kelola Karyawan')

@push('styles')
<style>
.twitter-typeahead {
    display: block !important;
}
.list-group-item {
    background: #fff !important;
}
.tt-dataset {
    margin-top: -20px !important;
}
</style>
@endpush

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>List Pegawai</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12 white-bg">
                <div class="pull-right button-add">
                    <a href="#" role="modal" class="btn btn-sm btn-primary" onclick="tambahKaryawan()"><i class="fa fa-plus"></i></a>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered" id="karyawanTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nik </th>
                            <th>Nama Karyawan </th>
                            <th>Jenis Kelamin </th>
                            <th>Tempat Lahir </th>
                            <th>Tanggal Lahir</th>
                            <th>ID Jabatan</th>
                            <th>Agama</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalKaryawan" tabindex="-1" role="dialog" aria-labelledby="modalKaryawanLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <form id="frmKaryawan">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama">Nik</label>
                            <input type="text" name="nik" class="form-control" required>
                            <span class="text-danger">
                                <strong id="nik-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="nama-error"></strong>
                            </span>
                        </div>
                         <div class="form-group">
                            <label for="id_jabatan">Pilih Jabatan</label>
                            <select name="id_jabatan" class="form-control" required>
                            @foreach($jabatan as $jabatan)
                                <option value="{!! $jabatan->nama_jabatan !!}">{!! $jabatan->nama_jabatan !!}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="id_jabatan-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Jenis Kelamin</label>
                            <input type="text" name="jk" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="jk-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="tempat_lahir-error"></strong>
                            </span>
                        </div>
                        <div class="form-group row" id="data_1">
                                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="tanggal_lahir" class="form-control">
                                </div>
                                <span class="text-danger">
                                    <strong id="tanggal_lahir-error"></strong>
                                </span>
                                </div>
                            </div>
                            <!--
                        <div class="form-group">
                            <label for="kode">ID Jabatan</label>
                            <input type="text" name="id_jabatan" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="id_jabatan-error"></strong>
                            </span>
                        </div>
                    -->
                     
                        <div class="form-group">
                            <label for="kode">Agama</label>
                            <input type="text" name="agama" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="agama-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">No Telepon</label>
                            <input type="text" name="no_tlp" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="no_tlp-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Alamat</label>
                            <input type="text" name="alamat" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="alamat-error"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-primary btn-simpan" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script src="{!! asset('js/typeahead.bundle.min.js') !!}"></script>
<script>
    var frmModal = $('#modalKaryawan');
    var form = $('#frmKaryawan');
    var formAction, table, uid;
    var method = 'POST';
    var styles = {
        button: function(row, type, data) {
            return '<a href="#" role="modal" onclick="updateKaryawan('+data.id+')" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-sm" onclick="deleteKaryawan('+data.id+')"><i class="fa fa-trash"></i></a>';
        },

        date: function(row, type, data) {
            var tanggal_lahir = data.tanggal_lahir;
            var tanggal_lahir = tanggal_lahir.split("-");
            var tanggal_lahir = tanggal_lahir[2] + '-' +tanggal_lahir[1] + '-' + tanggal_lahir[0] ;

            return tanggal_lahir;
        },
    };

    var resetForm = function() {
        method = 'POST';
        $('[name="nik"]').val('');
        $('[name="nama"]').val('');
        $('[name="jk"]').val('');
        $('[name="tempat_lahir"]').val('');
        $('[name="tanggal_lahir"]').val('');
        $('[name="id_jabatan"]').val('');
        $('[name="agama"]').val('');
        $('[name="no_tlp"]').val('');
        $('[name="alamat"]').val('');
        $('.modal-title').text('Tambah Data Karyawan');
    }
var mem = $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    var done = function(resp) {
        frmModal.modal('hide');
        table.ajax.reload();
    }

    var tambahKaryawan = function() {
        formAction = '{!! route('karyawan.create') !!}';
        resetForm();
        frmModal.modal('show');
    }

    var updateKaryawan = function(id) {

        $.ajax({
            url: 'karyawan/'+id+'/edit',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(resp) {
                formAction = 'karyawan/'+id+'/update';
                method = 'PUT';

                var data = resp.data;

                $('[name="nik"]').val(data.nik);
                $('[name="nama"]').val(data.nama);
                $('[name="jk"]').val(data.jk);
                $('[name="tempat_lahir"]').val(data.tempat_lahir);
                $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
                $('[name="id_jabatan"]').val(data.id_jabatan);
                $('[name="agama"]').val(data.agama);
                $('[name="no_tlp"]').val(data.no_tlp);
                $('[name="alamat"]').val(data.alamat);


                $('.modal-title').text('Edit Data karyawan');
                frmModal.modal('show');
            },
            error: function(resp) {
                frmModal.modal('hide');
                error(resp);
            }
        })
    }

    var deleteKaryawan = function(id) {
        swal({
            title: "Apa anda yakin?",
            text: "Data akan dihapus dan tidak bisa dikembalikan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: 'karyawan/'+id+'/delete',
                type: 'DELETE',
                data: { id: id },
                dataType: 'json',
                success: function(resp) {
                    done(resp);
                },
                error: function(resp) {
                    error(resp);
                }
            });
            swal("Berhasil!", "Data anda berhasil dihapus.", "success");
        });
    }

    $(function(){

        table = $('#karyawanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{!! route('tablekaryawan') !!}',
                type: 'POST',
            },
            columns: [
                { data: 'id' },
                { data: 'nik' },
                { data: 'nama' },
                { data: 'jk' },
                { data: 'tempat_lahir' },
                { data: 'tanggal_lahir' },
                { data: 'id_jabatan' },
                { data: 'agama' },
                { data: 'no_tlp' },
                { data: 'alamat' },
                { data: 'id', orderable: false, sClass:"text-center", render: styles.button }
            ]
        });

        $('.btn-simpan').click(function(e) {
            e.preventDefault();

            var data = form.serialize();

            $.ajax({
                url: formAction,
                method: method,
                data: data,
                dataType: 'json',
                success: function(resp) {
                     done(resp);    
                     swal({
                        title: "Berhasil!",
                        text: "Data berhasil disimpan!",
                        type: "success"
                    });
                },
                error: function(resp) {
                    if (resp.responseJSON.meta.message.nama){
                        $( '#nik-error' ).html( resp.responseJSON.meta.message.nik[0] );
                    }
                    if(resp.responseJSON.meta.message.kode){
                        $( '#nama-error' ).html( resp.responseJSON.meta.message.nama[0] );
                    }
                            }
            });
            
            return false;
        });
    });
</script>
@endpush
