@extends('layouts.app')
@section('content')
<!-- bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{!! __('general.my_dispo') !!}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{!! __('general.accueil') !!}</a></li>
                    <li class="active">{!! __('general.my_dispo') !!}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- fin bannière -->

<div class="content-area-7 my-properties">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @include('include.account')
            </div>

             <div class="col-lg-8 col-md-8 col-sm-12">
               <div class="mb-30" style="text-align:right">
                  <a class="button-md button-theme" href="{{ route('habitat.dispo', $detailHabitat['id_habitat']) }}">{!! __('general.add_dispo') !!}</a>
               </div>
                <table class="manage-table responsive-table">
                    <tbody>


                    @foreach($disposHabitat as $dispoHabitat)
                    <tr>
                        <td class="title-container">
                            <div class="title">
                                <span>Date début : {{ date('d/m/Y', strtotime($dispoHabitat->date_debut_disponibilites)) }}</span>
                                <span>Date fin : {{ date('d/m/Y', strtotime($dispoHabitat->date_fin_disponibilites)) }}</span>
                                <span>Prix : {{ $dispoHabitat->prix_disponibilites }} {{ $dispoHabitat->devise_prix_disponibilites }}</span>

                            </div>
                        </td>
                        <td class="action">
                            <a data-toggle="modal" data-target="#confirm-submit" data-id="{{ $dispoHabitat->id_disponibilite }}" data-name="{{ $dispoHabitat->id_habitat }}" class="confirmSupression"><i class="fa fa-remove"></i> {!! __('general.delete') !!}</a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
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
                {!! __('general.confirm_delete_dispo') !!}  ?
                <div class="pull-right mt-20">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('general.cancel') !!}</button>
                    <form id="formSuppression" action="{{ route('habitat.deleteDispo') }}" method="post" style="display:inline-block">
                       {{ csrf_field() }}
                        <a id="submitDelete" class="btn btn-success success">{!! __('general.delete') !!}</a>
                        <input type="hidden" name="id_dispo" id="id_dispo">
                        <input type="hidden" name="id_habitat" id="id_habitat">
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
  </div>
</div>

@endsection

@section('script')

    <script>

        $('#confirm-submit').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');
          var name = button.data('name');
          var modal = $(this);
          modal.find('.modal-body input#id_dispo').val(id);
          modal.find('.modal-body input#id_habitat').val(name);
        })


        $('#submitDelete').click(function(){
            $('#formSuppression').submit();
        });

    </script>
@endsection
