@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="col-md-6 col-sm-12 col-md-offset-3">
           <div class="submit-address">
                <form id="formCreateEquipement" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group @if ($errors->has('nameFr')) has-error @endif">
                        <label class="control-label">{!! __('general.type_bien') !!} ({!! __('general.french') !!})</label>
                        <input type="text" class="input-text" name="nameFr" placeholder="{!! __('general.type_bien') !!} ({!! __('general.french') !!})" value="{{ $typeBien[0]['libelle_fr_types_bien'] }}" autofocus>
                        <span class="help-block">@if ($errors->has('nameFr'))  {{ $errors->first('name')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('nameEn')) has-error @endif">
                        <label class="control-label">{!! __('general.type_bien') !!} ({!! __('general.english') !!})</label>
                        <input type="text" class="input-text" name="nameEn" placeholder="{!! __('general.type_bien') !!} ({!! __('general.english') !!})" value="{{ $typeBien[0]['libelle_en_types_bien'] }}" autofocus>
                        <span class="help-block">@if ($errors->has('nameEn'))  {{ $errors->first('nameEn')}} @endif</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{!! __('general.icon_type_name') !!}</label>
                        <img src="{{ asset('/public/img/type_bien/'.$typeBien[0]['icone_bien']) }}">
                        <input type="file" name="images">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id_types_bien" value="{{ $typeBien[0]['id_types_bien'] }}">
                        <input type="hidden" name="last_icon" value="{{ $typeBien[0]['icone_bien'] }}">
                        <input type="button" id="buttonSubmit" class="btn-block button-md button-theme pull-right" value="Modifier">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script>
    $('#buttonSubmit').on('click', function(e){
        e.preventDefault;
        $('#formCreateEquipement').submit();
    });

</script>
@endsection
