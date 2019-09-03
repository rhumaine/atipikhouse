@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="row">
           <div class="mb-30" style="text-align:right">
              <a class="button-md button-theme" href="{{ route('admin.createEquipement') }}">{!! __('general.add_equipment') !!}</a>
           </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width:80%">{!! __('general.equipment_name') !!}</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($allEquipements as $e)
                    <tr>
                        <td style="vertical-align:middle">
                            {{ $e['libelle_fr_types_equipement'] }} / {{ $e['libelle_en_types_equipement'] }}
                        </td>


                        <td>
                            <a href="{{ route('admin.editEquipement', $e['id_types_equipement']) }}" style="display:block"><i class="fa fa-pencil"></i> {!! __('general.modify') !!}</a>
                            <a data-toggle="modal" data-target="#confirm-submit" data-id="{{ $e['id_types_equipement'] }}" data-name="{{ $e['libelle_fr_types_equipement'] }}" class="confirmSupression"><i class="fa fa-remove"></i> {!! __('general.delete') !!}</a>                        </td>
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
                {!! __('general.confirm_delete_equipment') !!} "<span id="libelle_fr_types_equipement"></span>" ?
                <div class="pull-right mt-20">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('general.cancel') !!}</button>
                    <form id="formSuppression" action="{{ route('admin.deleteEquipement') }}" method="post" style="display:inline-block">
                       {{ csrf_field() }}
                        <a id="submitDelete" class="btn btn-success success">{!! __('general.delete') !!}</a>
                        <input type="hidden" name="id_equipement" id="id_equipement">
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
          modal.find('.modal-body input#id_equipement').val(id);
          modal.find('.modal-body #libelle_fr_types_equipement').html(name);
        })


        $('#submitDelete').click(function(){
            $('#formSuppression').submit();
        });

    </script>
@endsection

@endsection
