@extends('layouts.app')

@section('title', 'Kelola Detail Pinjam')

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
            <h2>List Detail Pinjam</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12 white-bg">
                <div class="pull-right button-add">
                    <a href="#" role="modal" class="btn btn-sm btn-primary" onclick="tambahDetailpinjam()"><i class="fa fa-plus"></i></a>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered" id="detailpinjamTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Detail Pinjam </th>
                            <th>Id Inventaris </th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetailpinjam" tabindex="-1" role="dialog" aria-labelledby="modalDetailpinjamLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <form id="frmDetailpinjam">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama">Id Detail Pinjam</label>
                            <input type="text" name="id_detail_pinjam" class="form-control" required>
                            <span class="text-danger">
                                <strong id="id_detail_pinjam-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="id_inventaris">Pilih Inventaris</label>
                            <select name="id_inventaris" class="form-control" required>
                            @foreach($inventaris as $inventaris)
                                <option value="{!! $inventaris->id_inventaris !!}">{!! $inventaris->nama !!}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="id_inventaris-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="jumlah-error"></strong>
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
    var frmModal = $('#modalDetailpinjam');
    var form = $('#frmDetailpinjam');
    var formAction, table, uid;
    var method = 'POST';
    var styles = {
        button: function(row, type, data) {
            return '<a href="#" role="modal" onclick="updateDetailpinjam('+data.id+')" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-sm" onclick="deleteDetailpinjam('+data.id+')"><i class="fa fa-trash"></i></a>';
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
        $('[name="id_detail_pinjam"]').val('');
        $('[name="id_inventaris"]').val('');
        $('[name="jumlah"]').val('');
        $('.modal-title').text('Tambah Data Detail Pinjam');
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

    var tambahDetailpinjam = function() {
        formAction = '{!! route('detailpinjam.create') !!}';
        resetForm();
        frmModal.modal('show');
    }

    var updateDetailpinjam = function(id) {

        $.ajax({
            url: 'detailpinjam/'+id+'/edit',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(resp) {
                formAction = 'detailpinjam/'+id+'/update';
                method = 'PUT';

                var data = resp.data;

                $('[name="id_detail_pinjam"]').val(data.id_detail_pinjam);
                $('[name="id_inventaris"]').val(data.id_inventaris);
                $('[name="jumlah"]').val(data.jumlah);
                $('.modal-title').text('Edit Data Detail Pinjam');
                frmModal.modal('show');
            },
            error: function(resp) {
                frmModal.modal('hide');
                error(resp);
            }
        })
    }

    var deleteDetailpinjam = function(id) {
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
                url: 'detailpinjam/'+id+'/delete',
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

        table = $('#detailpinjamTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{!! route('tabledetailpinjam') !!}',
                type: 'POST',
            },
            columns: [
                { data: 'id' },
                { data: 'id_detail_pinjam' },
                { data: 'id_inventaris' },
                { data: 'jumlah' },
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
