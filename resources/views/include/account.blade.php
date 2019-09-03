<div class="user-account-box">
    <div class="header clearfix">
        <div class="edit-profile-photo">
            <img src="{{Auth::user()->avatar}}" alt="agent-1" class="img-responsive">
        </div>
        <h3>{{Auth::user()->name}}</h3>
        <p>{{Auth::user()->email}}</p>
    </div>
    <div class="content">
       <div class="separateur-menu">
            {!! __('general.general') !!}
        </div>
        <ul>
            <li>
                <a href="{{route('user.profil')}}" @if(Request::is('account/profil')) class="active" @endif>{!! __('general.my_profile') !!}</a>
            </li>
            <li>
                <a href="{{route('user.edit')}}" @if(Request::is('account/profil/edit')) class="active" @endif>{!! __('general.profile_update') !!}</a>
            </li>
            <li>
                <a href="">{!! __('general.change_password') !!}</a>
            </li>
        </ul>
        <div class="separateur-menu">
            {!! __('general.locataire') !!}
        </div>
        <ul>
            <li>
                <a href="{{route('user.reservations')}}" @if(Request::is('account/reservations')) class="active" @endif>{!! __('general.my_resa') !!}</a>
            </li>
        </ul>
        <div class="separateur-menu">
            {!! __('general.proprietaire') !!}
        </div>
        <ul>
            <li>
                <a href="{{route('reservations.validation')}}" @if(Request::is('account/reservations/validation')) class="active" @endif>{!! __('general.resa_recues') !!}</a>
            </li>
            <li>
                <a href="{{route('user.habitats')}}" @if(Request::is('account/habitats')) class="active" @endif>{!! __('general.my_hebergements') !!}</a>
            </li>
            <li>
                <a href="{{route('user.activites')}}" @if(Request::is('account/activites')) class="active" @endif>{!! __('general.my_activities') !!}</a>
            </li>
            <li>
                <a href="{{route('habitat.create')}}" @if(Request::is('habitat/creer')) class="active" @endif>{!! __('general.add_hab') !!}</a>
            </li>
            <li>
                <a href="{{route('activite.create')}}" @if(Request::is('activite/creer')) class="active" @endif>{!! __('general.add_act') !!}</a>
            </li>
        </ul>
    </div>
</div>
