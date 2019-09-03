@extends('layouts.app')
@section('content')
<!-- Bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{!! __('general.contact_us') !!} </h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{!! __('general.accueil') !!}</a></li>
                    <li class="active">{!! __('general.contact_us') !!}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Fin bannière -->

<div class="contact-1 content-area-7">
    <div class="container">
        <div class="main-title">
            <h1>{!! __('general.contact_us') !!}</h1>
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                <!-- Contact form start -->
                <div class="contact-form">
                    <form id="contact_form" action="" method="GET" enctype="multipart/form-data">
                       @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group fullname">
                                    <input type="text" name="full-name" class="input-text" placeholder="{!! __('general.name') !!}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group enter-email">
                                    <input type="email" name="email" class="input-text" placeholder="{!! __('general.email') !!}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group subject">
                                    <input type="text" name="subject" class="input-text" placeholder="{!! __('general.object') !!}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group number">
                                    <input type="text" name="phone" class="input-text" placeholder="{!! __('general.phone_number') !!}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
                                <div class="form-group message">
                                    <textarea class="input-text" name="message" placeholder="{!! __('general.your_message') !!}"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group send-btn mb-0">
                                    <button type="submit" class="button-md button-theme">{!! __('general.send_message') !!}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-6 col-xs-12">
                <div class="contact-details">
                    <div class="main-title-2">
                        <h3>{!! __('general.our_adresse') !!}</h3>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="media-body">
                            <h4>{!! __('general.office_adress') !!}</h4>
                            <p>14 Rue Jules Michelet, 60350 Pierrefonds</p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h4>{!! __('general.phone_number') !!}</h4>
                            <p>
                                <a href="tel:+33370987665">{!! __('general.office') !!}: +33 370 98 76 65</a>
                            </p>
                        </div>
                    </div>
                    <div class="media mb-0">
                        <div class="media-left">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="media-body">
                            <h4>{!! __('general.email') !!}</h4>
                            <p>
                                <a href="mailto:contact@atypikhouse.fr">contact@atypikhouse.fr</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
