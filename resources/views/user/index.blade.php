@extends('layouts.app')

@section('title', 'Kelola User')

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
        <div class="col-lg-12">
            <h2>List User</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12 white-bg">
                <div class="pull-right button-add">
                    <a href="#" role="modal" class="btn btn-sm btn-primary" onclick="tambahUser()"><i class="fa fa-plus"></i></a>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered" id="userTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                           
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalUserLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <form id="formUser">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="id_petugas">Id Petugas</label>
                            <input type="text" name="id_petugas" class="form-control" required>
                            <span class="text-danger">
                                <strong id="id_petugas-error"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                            <span class="text-danger">
                                <strong id="nama-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" required="">
                            <span class="text-danger">
                                <strong id="email-error"></strong>
                            </span>
                        </div>                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" min-length="4" required="">
                            <span class="text-danger">
                                <strong id="password-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Pilih Role</label>
                            <select name="role_id" class="form-control" required>
                            @foreach($roles as $role)
                                <option value="{!! $role->id !!}">{!! $role->nama !!}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_level">Pilih level</label>
                            <select name="id_level" class="form-control" required>
                            @foreach($level as $level)
                                <option value="{!! $level->id_level !!}">{!! $level->nama_level !!}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="id_level-error"></strong>
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
    var frmModal = $('#modalUser');
    var form = $('#formUser');
    var formAction, table, uid;
    var method = 'POST';
    var styles = {
        button: function(row, type, data) {
            return '<a href="#" role="modal" onclick="updateUser('+data.id+')" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-sm" onclick="deleteUser('+data.id+')"><i class="fa fa-trash"></i></a>';
        },
    };

    var resetForm = function() {
        method = 'POST';
        $('[name="nama"]').val('');
        $('[name="email"]').val('');
        $('[name="password"]').val('');
        $('[name="id_petugas"]').val('');
        $('[name="id_level"]').val('');
        
        $('.modal-title').text('Tambah Data User');
    }

    var done = function(resp) {
        frmModal.modal('hide');
        table.ajax.reload();
    }

    var tambahUser = function() {
        formAction = '{!! route('user.create') !!}';
        resetForm();
        frmModal.modal('show');
    }

    var updateUser = function(id) {
 
        $.ajax({
            url: 'users/'+id+'/edit',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(resp) {
                formAction = 'users/'+id+'/update';
                method = 'PUT';

                var data = resp.data;
                $('[name="nama"]').val(data.nama);
                $('[name="email"]').val(data.email);
                $('[name="password"]').val(data.password);
                $('[name="role_id"]').val(data.role_id);
                $('[name="id_petugas"]').val(data.id_petugas);
                $('[name="id_level"]').val(data.id_level);
              

                $('.modal-title').text('Edit Data User');
                frmModal.modal('show');
            },
            error: function(resp) {
                frmModal.modal('hide');
                error(resp);
            }
        })
    }

    var deleteUser = function(id) {
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
                url: 'users/'+id+'/delete',
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

        var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/sekolah/find/data?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });

        var options = {
            minLength: 1,
            highlight: true,
        };
        
        $('#sekolah').typeahead(options, {
            source: bloodhound,
            display: function(data) {
                return data.nama
            },
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Data Tidak Tersedia.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function(data) {
                    return '<div style="font-weight:normal;" class="list-group-item">' + data.nama + '</div></div>'
                },
                footer: [
                    '</div>'
                ]
            }
        });

        $('#sekolah').bind('typeahead:select', function(ev, val) {
            $('[name="sekolah_id"]').val(val.id);
        });
        
        table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{!! route('tableUsers') !!}',
                type: 'POST',
            },
            columns: [
                { data: 'id' },
                { data: 'nama' },
                { data: 'email' },
                { data: 'role.nama' },
                { data: 'id', orderable: false, sClass:"text-center", render: styles.button }
            ]
        });

        $('.btn-simpan').click(function(e) {
            e.preventDefault();

            var data = form.serialize();
            
            $( '#nama-error' ).html( "" );
            $( '#email-error' ).html( "" );
            $( '#password-error' ).html( "" );

            $.ajax({
                url: formAction,
                method: method,
                data: data,
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
                        $( '#nama-error' ).html( resp.responseJSON.meta.message.nama[0] );
                    }
                    if(resp.responseJSON.meta.message.email){
                        $( '#email-error' ).html( resp.responseJSON.meta.message.email[0] );
                    }
                    if(resp.responseJSON.meta.message.password){
                    $( '#password-error' ).html( resp.responseJSON.meta.message.password[0] );   
                    }
                }
            });
            
            return false;
        });
    });
</script>
@endpush