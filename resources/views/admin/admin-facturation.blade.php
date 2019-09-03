@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="row">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Prix total</th>
                        <th>Date arrivée</th>
                        <th>Date départ</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($allFacturations as $c)
                    <tr>
                        <td style="vertical-align:middle">
                            {{ $c->id_facturation }}
                        </td>
                        <td style="vertical-align:middle">
                            {{ $c->user_name }}
                        </td>
                        <td style="vertical-align:middle">
                            {{ $c->user_prenom }}
                        </td>
                        <td style="vertical-align:middle">
                            {{ $c->user_email }}
                        </td>
                        <td style="vertical-align:middle">
                            {{ $c->user_telephone }}
                        </td>
                        <td style="vertical-align:middle">
                            {{ $c->facturation_prix_total }}
                        </td>
                        <td style="vertical-align:middle">
                            {{ date('d/m/Y', strtotime($c->facturation_date_arrivee )) }}
                        </td>
                        <td style="vertical-align:middle">
                            {{ date('d/m/Y', strtotime($c->facturation_date_depart)) }}
                        </td>
                        <td>
                            <a data-toggle="modal" data-target="#confirm-submit" data-id="{{ $c->id_facturation }}" class="confirmSupression"><i class="fa fa-remove"></i> {!! __('general.delete') !!}</a>
                        </td>
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
                {!! __('general.confirm_delete_field') !!} ?
                <div class="pull-right mt-20">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('general.cancel') !!}</button>
                    <form id="formSuppression" action="{{ route('admin.deleteFacturation') }}" method="post" style="display:inline-block">
                       {{ csrf_field() }}
                        <a id="submitDelete" class="btn btn-success success">{!! __('general.delete') !!}</a>
                        <input type="hidden" name="id_facturation" id="id_facturation">
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
          var modal = $(this);
          modal.find('.modal-body input#id_facturation').val(id);
        })


        $('#submitDelete').click(function(){
            $('#formSuppression').submit();
        });

    </script>
@endsection

@endsection
