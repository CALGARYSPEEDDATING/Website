{{-- @extends('frontend.layouts.app') --}}
@extends('frontend.includes.sidebar')
@push('after-styles')
<style>
.question-mark:hover .tooltiptext{
    cursor: pointer !important;
    visibility: visible !important;
}

  .question-mark .tooltiptext {
    visibility: hidden !important;
    width: 225px;
    background-color: #000000e3;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 10px 20px;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    text-align: justify;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
  }
</style>
@endpush
@section('side-content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
        <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <ul class="delete-pop">
                    <li>
                        <b>Before you delete your account, we want to inform you that you will lose access to all your past matches and chat history.</b>
                    </li>
                    <li>
                        <b> We will not be able to tell you who you matched with in the past, as we will no longer have access to your match results from the past.</b>
                    </li>
                    <li>
                        <b>If you delete your account, there is a chance that you may meet someone you have matched with in the past at our events again, even if you don't want to. This is because previous match history will be lost.</b>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-danger float-right cancel ml-3 close" data-dismiss="modal" aria-label="Close">No</button>
            <a href="{{route('frontend.user.accountDelete', auth()->user()->id)}}">
                <button type="submit" class="btn btn-success float-right">Yes</button>
            </a>
        </div>
    </div>
    </div>
</div>
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col col-sm-10 align-self-center">
            @if(session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <strong>
                        @lang('navs.frontend.user.account')
                    </strong>
                </div>

                <div class="card-body">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#profile" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab">@lang('navs.frontend.user.profile')</a>
                            </li>

                            <!-- <li class="nav-item">
                                <a href="#edit" class="nav-link" aria-controls="edit" role="tab" data-toggle="tab">@lang('labels.frontend.user.profile.update_information')</a>
                            </li> -->

                            @if($logged_in_user->canChangePassword())
                                <li class="nav-item">
                                    <a href="#password" class="nav-link" aria-controls="password" role="tab" data-toggle="tab">@lang('navs.frontend.user.change_password')</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link btn-danger text-white" data-target="#deleteModal" data-toggle="modal" type="button">@lang('navs.frontend.user.delete_account')</a>
                            </li>
                        </ul>
                            <a href="#questions" class="nav-link blink success">@lang('navs.frontend.user.scroll_down_for_profile_questions') &nbsp;<i class="fa fa-arrow-down"></i></a>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active pt-3" id="profile" aria-labelledby="profile-tab">
                                @include('frontend.user.account.tabs.profile')
                            </div><!--tab panel profile-->

                            <div role="tabpanel" class="tab-pane fade show pt-3" id="edit" aria-labelledby="edit-tab">
                                @include('frontend.user.account.tabs.edit')
                            </div>
                            <!--tab panel profile-->

                            @if($logged_in_user->canChangePassword())
                                <div role="tabpanel" class="tab-pane fade show pt-3" id="password" aria-labelledby="password-tab">
                                    @include('frontend.user.account.tabs.change-password')
                                </div><!--tab panel change password-->
                            @endif
                        </div><!--tab content-->
                    </div><!--tab panel-->
                </div><!--card body-->
            </div><!-- card -->
        </div><!-- col-xs-12 -->
    </div>

@endsection
