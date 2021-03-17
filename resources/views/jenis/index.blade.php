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
            <h2>List Jenis</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12 white-bg">
                <div class="pull-right button-add">
                    <a href="#" role="modal" class="btn btn-sm btn-primary" onclick="tambahJenis()"><i class="fa fa-plus"></i></a>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered" id="jenisTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Jenis </th>
                            <th>Nama Jenis </th>
                            <th>Kode Jenis</th>
                            <th>keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalJenis" tabindex="-1" role="dialog" aria-labelledby="modalJenisLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <form id="frmJenis">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama">Id Jenis</label>
                            <input type="text" name="id_jenis" class="form-control" required>
                            <span class="text-danger">
                                <strong id="id_jenis-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Nama Jenis</label>
                            <input type="text" name="nama_jenis" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="nama_jenis-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode Jenis</label>
                            <input type="text" name="kode_jenis" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="kode_jenis-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">keterangan</label>
                            <input type="text" name="keterangan" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="keterangan-error"></strong>
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
    var frmModal = $('#modalJenis');
    var form = $('#frmJenis');
    var formAction, table, uid;
    var method = 'POST';
    var styles = {
        button: function(row, type, data) {
            return '<a href="#" role="modal" onclick="updateJenis('+data.id+')" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-sm" onclick="deleteJenis('+data.id+')"><i class="fa fa-trash"></i></a>';
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
        $('[name="id_jenis"]').val('');
        $('[name="nama_jenis"]').val('');
        $('[name="kode_jenis"]').val('');
        $('[name="keterangan"]').val('');
        $('.modal-title').text('Tambah Data Jenis');
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

    var tambahJenis = function() {
        formAction = '{!! route('jenis.create') !!}';
        resetForm();
        frmModal.modal('show');
    }

    var updateJenis = function(id) {

        $.ajax({
            url: 'jenis/'+id+'/edit',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(resp) {
                formAction = 'jenis/'+id+'/update';
                method = 'PUT';

                var data = resp.data;

                $('[name="id_jenis"]').val(data.id_jenis);
                $('[name="nama_jenis"]').val(data.nama_jenis);
                $('[name="kode_jenis"]').val(data.kode_jenis);
                $('[name="keterangan"]').val(data.keterangan);
                $('.modal-title').text('Edit Data Jenis');
                frmModal.modal('show');
            },
            error: function(resp) {
                frmModal.modal('hide');
                error(resp);
            }
        })
    }

    var deleteJenis = function(id) {
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
                url: 'jenis/'+id+'/delete',
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

        table = $('#jenisTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{!! route('tablejenis') !!}',
                type: 'POST',
            },
            columns: [
                { data: 'id' },
                { data: 'id_jenis' },
                { data: 'nama_jenis' },
                { data: 'kode_jenis' },
                { data: 'keterangan' },
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
