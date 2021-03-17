@extends('layouts.app')

@section('title', 'Main page')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center m-t-lg">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                    <h1>Selamat datang di Inventaris kami</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop

@push('scripts')
<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}"></script>
<script src="{!! asset('js/pace.min.js') !!}"></script>
@endpush
