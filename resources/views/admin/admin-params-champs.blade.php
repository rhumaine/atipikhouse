@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="row">
           <div class="mb-30" style="text-align:right">
              <a class="button-md button-theme" href="{{ route('admin.createChamp') }}">{!! __('general.add_field') !!}</a>
           </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width:80%">{!! __('general.field_name') !!}</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($allChamps as $c)
                    <tr>
                        <td style="vertical-align:middle">
                            {{ $c->libelle_fr_champ_habitat }} / {{ $c->libelle_en_champ_habitat }}
                        </td>
                        <td>
                            <a href="{{ route('admin.editChamp',  $c->id_champ_habitat)}}" style="display:block"><i class="fa fa-pencil"></i> Modifier</a>
                            <a data-toggle="modal" data-target="#confirm-submit" data-id="{{ $c->id_champ_habitat }}" data-name="{{ $c->libelle_fr_champ_habitat }}" class="confirmSupression"><i class="fa fa-remove"></i> {!! __('general.delete') !!}</a>                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="modalPlanningLabel" style="z-index:10000">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {!! __('general.confirm_delete') !!}
            </div>
            <div class="modal-body">
                {!! __('general.confirm_delete_field') !!} "<span id="libelle_fr_champ_habitat"></span>" ?
                <div class="pull-right mt-20">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('general.cancel') !!}</button>
                    <form id="formSuppression" action="{{ route('admin.deleteChamp') }}" method="post" style="display:inline-block">
                       {{ csrf_field() }}
                        <a id="submitDelete" class="btn btn-success success">{!! __('general.delete') !!}</a>
                        <input type="hidden" name="id_champ" id="id_champ">
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        $('#confirm-submit').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');
          var name = button.data('name');
          var modal = $(this);
          modal.find('.modal-body input#id_champ').val(id);
          modal.find('.modal-body #libelle_fr_champ_habitat').html(name);
        })


        $('#submitDelete').click(function(){
            $('#formSuppression').submit();
        });

    </script>
@endsection

@endsection
