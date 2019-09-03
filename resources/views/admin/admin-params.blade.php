@extends('layouts.admin')
@section('content')



<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12 mb-30" style="">
                <a href="{{ route('admin.paramsEquipement') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.equipment') !!} </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xs-12  mb-30" style="">
                <a href="{{ route('admin.paramsChamps') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.other_fields') !!} </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
