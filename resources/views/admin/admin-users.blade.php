@extends('layouts.admin')
@section('content')

<div class="content-area-7 my-properties" style="padding-top:50px">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                 <div class="main-title-2">
                     <h1>{!! __('general.user_list') !!}</h1>
                 </div>
                <table class="manage-table responsive-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{!! __('general.inscription_date') !!}</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listeUsers as $user)
                                <tr>
                                    <td class="title-container">
                                        <div class="title">
                                            <h4>{{$user->name}}</h4>
                                            <span>{{$user->nom_user." ".$user->prenom_user }}
                                            @if(!empty($user->prenom_user))
                                                /
                                            @elseif(!empty($user->nom_user))
                                                /
                                            @endif
                                            {{ $user->email }}</span>
                                        </div>
                                    </td>
                            @if(!empty($user->created_at))
                                    <?php
                                        list($year, $month, $day) = explode("-", $user->created_at);
                                        $months = array("janvier", "février", "mars", "avril", "mai", "juin","juillet", "août", "septembre", "octobre", "novembre", "décembre");
                                        list($day, $time) = explode(" ", $day);
                                        $date_creation = $day." ".$months[$month-1]." ".$year;
                                    ?>

                                    <td class="expire-date hidden-xs">{{ $date_creation }}</td>
                            @else
                                    <td class="expire-date hidden-xs">{!! __('general.unknown') !!}</td>
                            @endif
                                    <td class="action">
                                        <a data-toggle="modal" data-target="#confirm-submit" data-id="{{ $user->id }}" class="confirmSupression"><i class="fa fa-remove"></i> {!! __('general.delete') !!}</a>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{!! __('general.cancel') !!}</button>
                <form id="formSuppression" action="{{ route('admin.supprimer') }}" method="post" style="display:inline-block">
                   {{ csrf_field() }}
                    <a id="submitDelete" class="btn btn-success success">{!! __('general.delete') !!}</a>
                    <input type="hidden" name="id_user" id="id_user">
                </form>
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
          modal.find('.modal-footer input#id_user').val(id);
        })


        $('#submitDelete').click(function(){
            $('#formSuppression').submit();
        });

    </script>
@endsection

@endsection


