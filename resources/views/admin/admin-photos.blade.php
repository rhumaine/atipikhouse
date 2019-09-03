@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="row">
           @foreach($photos as $p)
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img src="{{ asset('public/img/photos/commentaires/'.$p->url_commentaire_photo) }}" alt="{{ $p->legende}}">
                    <div class="caption">
                        <center>
                            <h4>{{ $p->legende}}</h4>

                            <a data-toggle="modal" data-target="#confirm-submit" data-id="{{ $p->id_commentaire_photo }}" data-name="{{ $p->legende }}" href="#" class="btn btn-danger confirmSupression" role="button">{!! __('general.delete') !!}</a>
                        </center>
                    </div>
                </div>
            </div>
            @endforeach
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
                {!! __('general.confirm_delete_photo') !!} "<span id="legende"></span>" ?
                <div class="pull-right mt-20">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('general.cancel') !!}</button>
                    <form id="formSuppression" action="{{ route('admin.photosDelete') }}" method="post" style="display:inline-block">
                       {{ csrf_field() }}
                        <a id="submitDelete" class="btn btn-success success">{!! __('general.delete') !!}</a>
                        <input type="hidden" name="id_commentaire_photo" id="id_commentaire_photo">
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
          modal.find('.modal-body input#id_commentaire_photo').val(id);
          modal.find('.modal-body #legende').html(name);
        })


        $('#submitDelete').click(function(){
            $('#formSuppression').submit();
        });

    </script>
@endsection

@endsection
