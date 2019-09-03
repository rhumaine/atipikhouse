@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px;min-height: calc(100vh - 147px);">
    <div class="container">
        <div class="row">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

            @foreach ($allCom as $c)
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{ $c['id_habitat'] }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $c['id_habitat'] }}" aria-expanded="false" aria-controls="collapse{{ $c['id_habitat'] }}">
                              {!! __('general.logement') !!} "{{ $c['titre_habitat'] }}"
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{ $c['id_habitat'] }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $c['id_habitat'] }}">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    @foreach ($c['commentaires'] as $co)
                                        <tr>
                                            <td style="vertical-align:middle">
                                                <div>{{ $co->name }}</div>
                                                <div class="comment-rating">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if($co->note_commentaire > $i)
                                                            <i class="fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div>
                                                    "{{ $co->texte_commentaire }}"
                                                </div>
                                            </td>


                                            <td width="20%" style="vertical-align:middle">
                                                <a data-toggle="modal" data-target="#confirm-submit" data-id="{{ $co->id_commentaires }}" class="confirmSupression"><i class="fa fa-remove"></i> {!! __('general.delete') !!}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                {!! __('general.confirm_delete_comm') !!}
                <div class="pull-right mt-20">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('general.cancel') !!}</button>
                    <form id="formSuppression" action="{{ route('admin.deleteCommentaire') }}" method="post" style="display:inline-block">
                       {{ csrf_field() }}
                        <a id="submitDelete" class="btn btn-success success">{!! __('general.confirm_delete') !!}</a>
                        <input type="hidden" name="id_commentaire" id="id_commentaire">
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
          modal.find('.modal-body input#id_commentaire').val(id);
        })


        $('#submitDelete').click(function(){
            $('#formSuppression').submit();
        });

    </script>
@endsection

@endsection
