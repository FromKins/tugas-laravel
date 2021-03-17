@extends('layouts.app')

@section('title', 'Kelola Jabatan')

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
            <h2>List Jabatan</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12 white-bg">
                <div class="pull-right button-add">
                    <a href="#" role="modal" class="btn btn-sm btn-primary" onclick="tambahJabatan()"><i class="fa fa-plus"></i></a>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered" id="jabatanTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Jabatan </th>
                            <th>Nama Jabatan </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalJabatan" tabindex="-1" role="dialog" aria-labelledby="modalJabatanLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <form id="frmJabatan">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama">ID Jabatan</label>
                            <input type="text" name="id_jabatan" class="form-control" required>
                            <span class="text-danger">
                                <strong id="id_jabatan-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="nama_jabatan-error"></strong>
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
    var frmModal = $('#modalJabatan');
    var form = $('#frmJabatan');
    var formAction, table, uid;
    var method = 'POST';
    var styles = {
        button: function(row, type, data) {
            return '<a href="#" role="modal" onclick="updateJabatan('+data.id+')" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-sm" onclick="deleteJabatan('+data.id+')"><i class="fa fa-trash"></i></a>';
        },
    };

    var resetForm = function() {
        method = 'POST';
        $('[name="id_jabatan"]').val('');
        $('[name="nama_jabatan"]').val('');
        $('.modal-title').text('Tambah Data Jabatan');
    }

    var done = function(resp) {
        frmModal.modal('hide');
        table.ajax.reload();
    }

    var tambahJabatan = function() {
        formAction = '{!! route('jabatan.create') !!}';
        resetForm();
        frmModal.modal('show');
    }

    var updateJabatan = function(id) {

        $.ajax({
            url: 'jabatan/'+id+'/edit',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(resp) {
                formAction = 'jabatan/'+id+'/update';
                method = 'PUT';

                var data = resp.data;

                $('[name="id_jabatan"]').val(data.id_jabatan);
                $('[name="nama_jabatan"]').val(data.nama_jabatan);


                $('.modal-title').text('Edit Data jabatan');
                frmModal.modal('show');
            },
            error: function(resp) {
                frmModal.modal('hide');
                error(resp);
            }
        })
    }

    var deleteJabatan = function(id) {
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
                url: 'jabatan/'+id+'/delete',
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

        table = $('#jabatanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{!! route('tablejabatan') !!}',
                type: 'POST',
            },
            columns: [
                { data: 'id' },
                { data: 'id_jabatan' },
                { data: 'nama_jabatan' },
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
                        $( '#id_jabatan-error' ).html( resp.responseJSON.meta.message.id_jabatan[0] );
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