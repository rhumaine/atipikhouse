@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="col-md-6 col-sm-12 col-md-offset-3">
           <div class="submit-address">
                <form id="formCreateChamp" method="post">
                @csrf
                    <div class="form-group @if ($errors->has('nameFr')) has-error @endif">
                        <label class="control-label">{!! __('general.field_name') !!} ({!! __('general.french') !!})</label>
                        <input type="text" class="input-text" name="nameFr" placeholder="Nom du champ (Français)" value="{{ $champ[0]['libelle_fr_champ_habitat'] }}" autofocus>
                        <span class="help-block">@if ($errors->has('nameFr'))  {{ $errors->first('name')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('nameEn')) has-error @endif">
                        <label class="control-label">{!! __('general.field_name') !!} ({!! __('general.english') !!})</label>
                        <input type="text" class="input-text" name="nameEn" placeholder="Nom du champ (Anglais)" value="{{ $champ[0]['libelle_en_champ_habitat'] }}" autofocus>
                        <span class="help-block">@if ($errors->has('nameEn'))  {{ $errors->first('nameEn')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('typeChamp')) has-error @endif">
                        <label class="control-label">{!! __('general.type_champ') !!}</label>
                        <select class="selectpicker search-fields" name="typeChamp">
                            <option disabled selected> -- {!! __('general.select') !!} -- </option>
                            <option value="text" @if($champ[0]['champ_habitat_type'] == "text") selected @endif>{!! __('general.text') !!}</option>
                            <option value="number" @if($champ[0]['champ_habitat_type'] == "number") selected @endif>{!! __('general.number') !!}</option>
                        </select>
                        <span class="help-block">@if ($errors->has('typeChamp'))  {{ $errors->first('typeChamp')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('typeBien')) has-error @endif">
                        <label class="control-label">{!! __('general.type_bien') !!}</label>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="checkbox checkbox-theme checkbox-circle">
                                    <input id="checkboxAll" type="checkbox" name="typeBien[]" onClick="ckChange(this)" value="All" @if(is_array(old('typeBien')) && in_array($typeBien->id_types_bien, old('typeBien'))) checked @endif>
                                    <label for="checkboxAll">
                                        {!! __('general.all') !!}
                                    </label>
                                </div>
                            </div>
                                @foreach($typeBiens as $typeBien)
                                <?php
                                    $checked = "";
                                    foreach($typeBiensOfChamp as $p){
                                        if($p['id_type_bien'] == $typeBien->id_types_bien){
                                            $checked = "checked";
                                        }
                                    }
                                ?>
                               <div class="col-xs-6">
                                    <div class="checkbox checkbox-theme checkbox-circle">
                                        <input id="checkbox{{ $typeBien->id_types_bien }}" onClick="ckChange(this)" type="checkbox" name="typeBien[]" value="{{ $typeBien->id_types_bien }}" {{ $checked }} >
                                        <label for="checkbox{{ $typeBien->id_types_bien }}">
                                            {{ $typeBien->libelle_fr_types_bien }}

                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                     <input type="hidden" name="id_champ_habitat" value="{{ $champ[0]['id_champ_habitat']}}">
                      <input type="button" id="buttonSubmit" class="btn-block button-md button-theme pull-right" value="{!! __('general.modify') !!}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')

<script>

    function ckChange(ckType){
        var ckName = document.getElementsByName(ckType.name);
        var checked = document.getElementById(ckType.id);

        if (checked.checked) {

            for(var i=0; i < ckName.length; i++){
                if(!ckName[i].checked){
                    if(ckType.id === "checkboxAll"){
                        $( '#' + ckName[i].id +'' ).prop( "checked", true );
                        ckName[i].disabled = true;
                    }else{
                        ckName[i].disabled = false;
                    }
                }else{
                    ckName[i].disabled = false;

                }
            }
        }else {
          for(var i=0; i < ckName.length; i++){
            ckName[i].disabled = false;
          }
        }
    }

    $('#buttonSubmit').on('click', function(e){
        e.preventDefault;
        $('#formCreateChamp').submit();
    });

</script>
@endsection
