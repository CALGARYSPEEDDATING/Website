{{ html()->modelForm($logged_in_user, 'POST', route('frontend.user.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    @method('PATCH')

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.avatar'))->for('avatar') }}

                <div>
                    <input type="radio" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> Gravatar
                    <input type="radio" name="avatar_type" value="storage" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> Upload

                    @foreach($logged_in_user->providers as $provider)
                        @if(strlen($provider->avatar))
                            <input type="radio" name="avatar_type" value="{{ $provider->provider }}" {{ $logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                        @endif
                    @endforeach
                </div>
            </div><!--form-group-->

            <div class="form-group hidden" id="avatar_location">
                {{ html()->file('avatar_location')->class('form-control') }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                {{ html()->text('first_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.first_name'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                {{ html()->text('last_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.last_name'))
                    ->attribute('maxlength', 191)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
              <div class="form-group">
                    <label for="profile">Interest</label>
                    <textarea  class="form-control" name="profile">{{ ($logged_in_user->profile->profile !='') ? $logged_in_user->profile->profile : 'international man of mystery" for men and "international woman of mystery" for women.' }}</textarea>
                  </div>
        </div><!--col-->
    </div><!--row-->
    <div class="row">
        <div class="col">
              <div class="form-group">
                    <label for="matches_info">Contact info</label>
                    <input value="{{ $logged_in_user->profile->matches_info }}" class="form-control" type="text" name="matches_info">
                  </div>
        </div><!--col-->
    </div><!--row-->
    {{-- Questions --}}
    <hr>
    <div class="row">
        <div class="col">
            <p style="margin: 0 0 10px 0;color:green" >The profile questions are a set of questions you answer. Once you are at the event,
                you will get a paper containing all the answered questions of all the ladies or men ( depending on your gender
                who are coming to the event also.   It is a jumping-off point for conversation.
                You are not selling yourself' or 'shopping for a commodity' as you might in an internet dating profile.
                It is more general. Keep your answers short and in point form. It's about skimming, not reading.
                Answer only the questions you want to answer. Please keep it to about 50 words.
                If you choose not to create a Profile, your profile will read 'International Man/Woman of Mystery</p>
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
              <div class="form-group">
                    <label for="question_one">What do you like to do when you're not working?</label>
                    <textarea  class="form-control" name="question_one">{{$logged_in_user->profile->question_one}}</textarea>
                  </div>
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
              <div class="form-group">
                    <label for="question_two">How would your best friend describe you?</label>
                    <textarea  class="form-control" name="question_two">{{$logged_in_user->profile->question_two}}</textarea>
                  </div>
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
              <div class="form-group">
                    <label for="question_three">What is your dream vacation?</label>
                    <textarea  class="form-control" name="question_three">{{$logged_in_user->profile->question_three}}</textarea>
                  </div>
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
              <div class="form-group">
                    <label for="question_four">What are you most passionate about?</label>
                    <textarea  class="form-control" name="question_four">{{$logged_in_user->profile->question_four}}</textarea>
                  </div>
        </div><!--col-->
    </div><!--row-->

     <div class="row">
        <div class="col">
              <div class="form-group">
                    <label for="a_phone">Alternate Phone</label>
                    <input value="{{ $logged_in_user->profile->a_phone }}" class="form-control" type="text" name="a_phone">
                  </div>
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
              <div class="form-group">
                    <input type="checkbox" {{  $logged_in_user->profile->subscribed != 0 ? 'checked' : '' }} class="form-check-input" name="subscribed" id="subscribed">
                    <label class="form-check-label" for="subscribed">Subscribe</label>
                  </div>
        </div><!--col-->
    </div><!--row-->


<div class="row">
        <div class="col">
              <div class="form-group">
                    <input type="checkbox" {{  $logged_in_user->profile->show_image != 0 ? 'checked' : '' }} class="form-check-input" name="show_image" id="show_image">
                    <label class="form-check-label" for="show_image">Show Image</label>
                  </div>
        </div><!--col-->
    </div><!--row-->

    @if ($logged_in_user->canChangeEmail())
        <div class="row">
            <div class="col">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
                </div>

                <div class="form-group">
                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    @endif

    <div class="row">
        <div class="col">
            <div class="form-group mb-0 clearfix">
                {{ form_submit(__('labels.general.buttons.update')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->closeModelForm() }}

@push('after-scripts')
    <script>
        $(function() {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });
    </script>
@endpush
