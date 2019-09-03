@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="col-md-6 col-sm-12 col-md-offset-3">
           <div class="submit-address">
                <form id="formCreateEntreprise" action="{{ route('admin.updateEntreprise' )}}"  method="post">
                @csrf
                    <div class="form-group @if ($errors->has('nameFr')) has-error @endif">
                        <label class="control-label">{!! __('general.field_name_entreprise') !!}</label>
                        <input type="text" class="input-text" name="nameFr" value="{{ $entreprise[0]->libelle_entreprise }}" placeholder="{!! __('general.field_name_entreprise') !!}" value="" autofocus>
                        <span class="help-block">@if ($errors->has('nameFr'))  {{ $errors->first('name')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('description_fr')) has-error @endif">
                        <label class="control-label">{!! __('general.description') !!} {!! __('general.french') !!}</label>
                        <textarea name="description_fr">{{ $entreprise[0]->description_fr_entreprise }}</textarea>
                        <span class="help-block">@if ($errors->has('description_fr'))  {{ $errors->first('description_fr')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('description_en')) has-error @endif">
                        <label class="control-label">{!! __('general.description') !!} {!! __('general.english') !!}</label>
                        <textarea name="description_en">{{ $entreprise[0]->description_en_entreprise }}</textarea>
                        <span class="help-block">@if ($errors->has('description_en'))  {{ $errors->first('description_en')}} @endif</span>
                    </div>

                    <div class="form-group @if ($errors->has('adresse')) has-error @endif">
                        <label class="control-label">{!! __('general.adresse') !!}</label>
                        <input type="text" class="input-text" name="adresse" placeholder="{!! __('general.adresse') !!}" value="{{ $entreprise[0]->adresse_entreprise }}" autofocus>
                        <span class="help-block">@if ($errors->has('adresse'))  {{ $errors->first('adresse')}} @endif</span>
                    </div>
                   <div class="form-group @if ($errors->has('ville')) has-error @endif">
                        <label class="control-label">{!! __('general.ville') !!}</label>
                        <input type="text" class="input-text" name="ville" placeholder="{!! __('general.ville') !!}" value="{{ $entreprise[0]->ville_entreprise }}" autofocus>
                        <span class="help-block">@if ($errors->has('ville'))  {{ $errors->first('ville')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('code_postal')) has-error @endif">
                        <label class="control-label">{!! __('general.code_postal') !!}</label>
                        <input type="text" class="input-text" name="code_postal" placeholder="{!! __('general.code_postal') !!}" value="{{ $entreprise[0]->code_postal_entreprise }}" autofocus>
                        <span class="help-block">@if ($errors->has('code_postal'))  {{ $errors->first('code_postal')}} @endif</span>
                    </div>
                    <div class="form-group @if ($errors->has('telephone')) has-error @endif">
                        <label class="control-label">{!! __('general.telephone') !!}</label>
                        <input type="text" class="input-text" name="telephone" placeholder="{!! __('general.telephone') !!}" value="{{ $entreprise[0]->telephone_entreprise }}" autofocus>
                        <span class="help-block">@if ($errors->has('telephone'))  {{ $errors->first('telephone')}} @endif</span>
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
        $('#formCreateEntreprise').submit();
    });

</script>
@endsection
