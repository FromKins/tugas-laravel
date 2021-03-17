@extends('layouts.app')

@section('title', 'Kelola inventaris')

@push('styles')
<link rel="stylesheet" href="{!! asset('css/clockpicker.css') !!}" />
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
            <h2>List Inventaris</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12 white-bg">
                <div class="pull-right button-add">
                    <a href="#" role="modal" class="btn btn-sm btn-primary" onclick="tambahInventaris()"><i class="fa fa-plus"></i></a>
                    <a href="{{URL::to('inventaris/Printpreview')}}" class="btn btn-sm btn-primary btnPrint"><i class="fa fa-print"></i></a>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered" id="inventarisTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Inventaris</th>
                            <th>Nama</th>
                            <th>Kondisi</th>
                            <th>keterangan</th>
                            <th>Jumlah</th>
                            <th>Nama Petugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalInventaris" tabindex="-1" role="dialog" aria-labelledby="modalInventarisLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <form id="frmInventaris">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama">Id Inventaris</label>
                            <input type="text" name="id_inventaris" class="form-control" required>
                            <span class="text-danger">
                                <strong id="id_inventaris-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Nama</label>
                            <input type="text" name="nama" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="nama-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Kondisi</label>
                            <input type="text" name="kondisi" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="kondisi-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="keterangan-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="kode">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="jumlah-error"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="id_jenis">Pilih jenis</label>
                            <select name="id_jenis" class="form-control" required>
                            @foreach($jenis as $jenis)
                                <option value="{!! $jenis->id_jenis !!}">{!! $jenis->nama_jenis !!}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="id_jenis-error"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="kode">Tanggal Register</label>
                            <input type="text" name="tanggal_register" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="tanggal_register-error"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="id_ruang">Pilih ruang</label>
                            <select name="id_ruang" class="form-control" required>
                            @foreach($ruang as $ruang)
                                <option value="{!! $ruang->id_ruang !!}">{!! $ruang->nama_ruang !!}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="id_ruang-error"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="kode">Kode Inventaris</label>
                            <input type="text" name="kode_inventaris" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="kode_inventaris-error"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="kode">Id Petugas</label>
                            <input type="text" name="id_petugas" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="id_petugas-error"></strong>
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
<script src="{!! asset('js/clockpicker.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/jquery.printPage.js') !!}"></script>

<script>
    $(document).ready(function(){
            $('.btnPrint').printPage();
        });

    $('.clockpicker').clockpicker();
    var frmModal = $('#modalInventaris');
    var form = $('#frmInventaris');
    var formAction, table, uid;
    var method = 'POST';
    var styles = {
        button: function(row, type, data) {
            return '<a href="#" role="modal" onclick="updateInventaris('+data.id+')" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-sm" onclick="deleteInventaris('+data.id+')"><i class="fa fa-trash"></i></a>';
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
        $('[name="id_inventaris"]').val('');
        $('[name="nama"]').val('');
        $('[name="kondisi"]').val('');
        $('[name="keterangan"]').val('');
        $('[name="jumlah"]').val('');
        $('[name="id_jenis"]').val('');
        $('[name="tanggal_register"]').val('');
        $('[name="id_ruang"]').val('');
        $('[name="kode_inventaris"]').val('');
        $('[name="id_petugas"]').val('');
        $('.modal-title').text('Tambah Data Inventaris');
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

    var tambahInventaris = function() {
        formAction = '{!! route('inventaris.create') !!}';
        resetForm();
        frmModal.modal('show');
    }

    var updateInventaris = function(id) {

        $.ajax({
            url: 'inventaris/'+id+'/edit',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(resp) {
                formAction = 'inventaris/'+id+'/update';
                method = 'PUT';

                var data = resp.data;

                $('[name="id_inventaris"]').val(data.id_inventaris);
                $('[name="nama"]').val(data.nama);
                $('[name="kondisi"]').val(data.kondisi);
                $('[name="keterangan"]').val(data.keterangan);
                $('[name="jumlah"]').val(data.jumlah);
                $('[name="id_jenis"]').val(data.id_jenis);
                $('[name="tanggal_register"]').val(data.tanggal_register);
                $('[name="id_ruang"]').val(data.id_ruang);
                $('[name="kode_inventaris"]').val(data.kode_inventaris);
                $('[name="id_petugas"]').val(data.id_petugas);
                $('.modal-title').text('Edit Data inventaris');
                frmModal.modal('show');
            },
            error: function(resp) {
                frmModal.modal('hide');
                error(resp);
            }
        })
    }

    var deleteInventaris = function(id) {
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
                url: 'inventaris/'+id+'/delete',
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

        table = $('#inventarisTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{!! route('tableinventaris') !!}',
                type: 'POST',
            },
            columns: [
                { data: 'id' },
                { data: 'id_inventaris' },
                { data: 'nama' },
                { data: 'kondisi' },
                { data: 'keterangan' },
                { data: 'jumlah' },
                { data: 'id_petugas' },
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
