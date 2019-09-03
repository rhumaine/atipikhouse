@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="row">
           <div class="col-md-3 col-sm-6 col-xs-12  mb-30" style="">
                <a href="{{ route('admin.entreprise') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.entreprise') !!} </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 mb-30" style="">
                <a href="{{ route('admin.users') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.user_list') !!} </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 mb-30" style="">
                <a href="{{ route('admin.facturation') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.facturation') !!} </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 mb-30" style="">
                <a href="{{ route('admin.activites') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.activities') !!} </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12  mb-30" style="">
                <a href="{{ route('admin.typeBien') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.type_de_bien') !!} </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12  mb-30" style="">
                <a href="{{ route('admin.params') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.hab_params') !!} </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12  mb-30" style="">
                <a href="{{ route('admin.commentaire') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.comments') !!} </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12  mb-30" style="">
                <a href="{{ route('admin.photos') }}">
                    <div style="border:1px solid #1c8946;border-radius:20px;height:200px;display: flex;align-items: center;justify-content: center;">
                        <div style="text-align:center;font-size:1.5em"> {!! __('general.photo') !!} </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
