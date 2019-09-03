@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="col-md-6 col-sm-12 col-md-offset-3">
           <div class="submit-address">
                <form id="formCreateEquipement" method="post">
                @csrf
                    <div class="form-group @if ($errors->has('nameFr')) has-error @endif">
                        <label class="control-label">{!! __('general.equipment_name') !!} ({!! __('general.french') !!})</label>
                        <input type="text" class="input-text" name="nameFr" placeholder="{!! __('general.equipment_name') !!} ({!! __('general.french') !!})" value="" autofocus>
                        <span class="help-block">@if ($errors->has('nameFr'))  {{ $errors->first('name')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('nameEn')) has-error @endif">
                        <label class="control-label">{!! __('general.equipment_name') !!} ({!! __('general.english') !!})</label>
                        <input type="text" class="input-text" name="nameEn" placeholder="{!! __('general.equipment_name') !!} ({!! __('general.english') !!})" value="" autofocus>
                        <span class="help-block">@if ($errors->has('nameEn'))  {{ $errors->first('nameEn')}} @endif</span>
                    </div>
                    <div class="form-group">
                      <input type="button" id="buttonSubmit" class="btn-block button-md button-theme pull-right" value="{!! __('general.save') !!}">
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
