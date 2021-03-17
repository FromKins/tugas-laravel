@extends('layouts.app')

@section('title', 'Kelola Jabatan')
@push('styles')
    <link rel="stylesheet" href="{!! asset('css/clockpicker.css') !!}" />
    
@endpush
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
<head>
   
</head>
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>List Gaji</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12 white-bg">
                <div class="pull-right button-add">
                    <a href="#" role="modal" class="btn btn-sm btn-primary" onclick="tambahGaji()"><i class="fa fa-plus"></i></a>
                     <a href="{{URL::to('gaji/Printpreview')}}" class="btn btn-sm btn-primary btnPrint"><i class="fa fa-print"></i></a>
                </div>

                <div class="clearfix"></div>
                <table class="table table-bordered" id="gajiTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Karyawan</th>
                            <th>Gaji</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Total Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalGaji" tabindex="-1" role="dialog" aria-labelledby="modalGajiLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <form id="frmGaji" name="hitunggaji">
                    <div class="modal-body">
                        {{ csrf_field() }}

                         <div class="form-group">
                            <label for="karyawan_id">Pilih Karyawan id</label>
                            <select name="karyawan_id" class="form-control" required>
                            @foreach($karyawan as $karyawan)
                                <option value="{{$karyawan->nama }}">{{ $karyawan->id }}</option>
                            @endforeach
                            </select>
                        </div>                 
                                            
                        
                        <div class="form-group">
                            <label for="kode">Hari</label>
                            <input type="text" name="hari" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="hari-error"></strong>
                            </span>
                        </div>
                        <!-- <div class="form-group">
                            <label for="kode">Jam</label>
                            <input type="text" name="jam" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="jam-error"></strong>
                            </span>
                        </div> -->
                       <!-- <div class="form-group">
                            <label for="jam">Jam</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" name="jam" class="form-control">
                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                            </div>
                            <span class="text-danger">
                                <strong id="jam-error"></strong>
                            </span>
                        </div> -->      
                         <br><input type="button" onclick="hitung()" value="check" class="btn btn-warning"></input>

                         <div class="form-group">
                            <label for="kode">Gaji Perhari</label>
                            <input type="text" name="gaji" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="gaji-error"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="kode">Total Gaji</label>
                            <input type="text" name="totalgaji" class="form-control" max-length="3">
                            <span class="text-danger">
                                <strong id="totalgaji-error"></strong>
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
<!-- <script src="{!! asset('js/jquery-1.12.0.min.zopfli.js') !!}"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="{!! asset('js/jquery.printPage.js') !!}"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
<script src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
<script>
$(document).ready(function(){
            $('.btnPrint').printPage();
        });

    $('.clockpicker').clockpicker();
    var frmModal = $('#modalGaji');
    var form = $('#frmGaji');
    var formAction, table, uid;
    var method = 'POST';
    var styles = {
        button: function(row, type, data) {
            return '<a href="#" role="modal" onclick="updateGaji('+data.id+')" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-sm" onclick="deleteGaji('+data.id+')"><i class="fa fa-trash"></i></a>';
        },
    };

    var resetForm = function() {
        method = 'POST';
        $('[name="karyawan_id"]').val('');
        $('[name="gaji"]').val('');
        $('[name="hari"]').val('');
        $('[name="jam"]').val('');
        $('[name="totalgaji"]').val('');
        $('.modal-title').text('Tambah Data Gaji');
    }

    var done = function(resp) {
        frmModal.modal('hide');
        table.ajax.reload();
    }

    var tambahGaji = function() {
        formAction = '{!! route('gaji.create') !!}';
        resetForm();
        frmModal.modal('show');
    }
         function hitung() {  
            var gaji= parseFloat(document.hitunggaji.gaji.value);  
            if (isNaN(gaji)) {gaji=0.0;}  
            var hari=parseFloat(document.hitunggaji.hari.value);  
            if (isNaN(hari)) {hari=0.0;}
            // var jam=parseFloat(document.hitunggaji.jam.value);  
            // if (isNaN(jam)) {jam=0.0;}
           
           
            // var hasil = (((gaji * 1) / 173) * jam) * hari;
            var hasil = gaji * hari;
            // var status = $karyawan_id = '1';

            // $karyawan_id = '1';
            // if ($karyawan_id == '1')
            // {
            //    document.hitunggaji.gaji.value= "5000000";
            // }
            // else if ($karyawan_id == '2')
            // {
            //    document.hitunggaji.gaji.value= "3000000";
            // }
            // else ($karyawan_id == '3')
            // {
            //    document.hitunggaji.gaji.value= "1000000";
            // }
                            $karyawan_id = '';
                            if ($karyawan_id == 1) {
                               document.hitunggaji.gaji.value= "5000000";
                            } else if ($karyawan_id == 2) {
                                document.hitunggaji.gaji.value= "4000000";
                            } else if ($karyawan_id == 3) {
                                document.hitunggaji.gaji.value= "3000000";
                            } else {
                               document.hitunggaji.gaji.value= "2000000";
                             }

           
            document.hitunggaji.totalgaji.value= hasil;
            
            }
    var updateGaji = function(id) {

        $.ajax({
            url: 'gaji/'+id+'/edit',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(resp) {
                formAction = 'gaji/'+id+'/update';
                method = 'PUT';

                var data = resp.data;

                $('[name="karyawan_id"]').val(data.karyawan_id);
                $('[name="gaji"]').val(data.gaji);
                $('[name="hari"]').val(data.hari);
                $('[name="jam"]').val(data.jam);
                $('[name="totalgaji"]').val(data.totalgaji);


                $('.modal-title').text('Edit Data jabatan');
                frmModal.modal('show');
            },
            error: function(resp) {
                frmModal.modal('hide');
                error(resp);
            }
        })
    }

    var deleteGaji = function(id) {
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
                url: 'gaji/'+id+'/delete',
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

        table = $('#gajiTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{!! route('tablegaji') !!}',
                type: 'POST',
            },
            columns: [
                { data: 'id' },
                { data: 'karyawan_id' },
                { data: 'gaji' },
                { data: 'hari' },
                { data: 'jam' },
                { data: 'totalgaji' },
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