@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="row">
           <div class="mb-30" style="text-align:right">
              <a class="button-md button-theme" href="{{ route('admin.createTypeBien') }}">{!! __('general.add_type') !!}</a>
           </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width:80%">{!! __('general.type_name') !!}</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($listeTypeBien as $t)
                    <tr>
                        <td style="vertical-align:middle">
                            {{ $t->libelle_fr_types_bien }} / {{ $t->libelle_en_types_bien }}
                        </td>
                        <td>
                            <a href="{{ route('admin.editTypeBien',  $t->id_types_bien)}}" style="display:block"><i class="fa fa-pencil"></i> Modifier</a>
                            <a data-toggle="modal" data-target="#confirm-submit" data-id="{{ $t->id_types_bien }}" data-name="{{ $t->libelle_fr_types_bien }}" class="confirmSupression"><i class="fa fa-remove"></i> {!! __('general.delete') !!}</a>                        </td>
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
                {!! __('general.confirm_delete_field') !!} "<span id="libelle_fr_type_bien"></span>" ?
                <div class="pull-right mt-20">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('general.cancel') !!}</button>
                    <form id="formSuppression" action="{{ route('admin.deleteTypeBien') }}" method="post" style="display:inline-block">
                       {{ csrf_field() }}
                        <a id="submitDelete" class="btn btn-success success">{!! __('general.delete') !!}</a>
                        <input type="hidden" name="id_types_bien" id="id_types_bien">
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
          modal.find('.modal-body input#id_types_bien').val(id);
          modal.find('.modal-body #libelle_fr_type_bien').html(name);
        })


        $('#submitDelete').click(function(){
            $('#formSuppression').submit();
        });

    </script>
@endsection

@endsection
