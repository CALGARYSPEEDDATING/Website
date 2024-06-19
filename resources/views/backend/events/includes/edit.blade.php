<form method="post" action="{{ route('admin.event.update', $event->id)}}" enctype="multipart/form-data">
        @method('Patch')
        @csrf

        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="company">Event Title</label>

            <div class="col-md-9">
           
            <input class="form-control" value="{{$event->title}}" type="text" name="title" id="organization" placeholder="Event Title"
                    maxlength="191" required="" autofocus="">
            </div>
            <!--col-->
        </div>






        <div class="form-group row">
            <label for="address" class=" col-sm-2 col-form-label">Location</label>
            <div class="col-md-9">
                <input value="{{$event->address}}" class="form-control" name="address" placeholder="Location" type="text" id="address">
            </div>

        </div>

        <div class="form-group">
            <div class="row">
                <label for="edit_start_date" class="col-md-2 col-form-label">Event Start Date/Time</label>

                <div class="col-md-4 ">
                    <div class="form-group">
                        <div class="input-group date" id="edit_start_date" data-target-input="nearest">

                            <input name="edit_start_date" type="text" class="form-control datetimepicker-input"
                                data-toggle="datetimepicker" data-target="#edit_start_date" />
                            <div class="input-group-append" data-target="#edit_start_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-md-4 offset-md-1">
                    <div class="form-group">

                        <div class="form-group">
                            <div class="input-group date" id="edit_start_time" data-target-input="nearest">

                                <input type="text" name="edit_start_time" class="form-control datetimepicker-input"
                                    data-toggle="datetimepicker" data-target="#edit_start_time" />
                                <div class="input-group-append" data-target="#edit_start_time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>





        <div class="form-group">
            <div class="row">
                <label for="edit_end_date" class="col-md-2 col-form-label">Event End Date/Time</label>

                <div class="col-md-4 ">
                    <div class="form-group">
                        <div class="input-group date" id="edit_end_date" data-target-input="nearest">

                            <input name="edit_end_date" type="text" class="form-control datetimepicker-input"
                                data-toggle="datetimepicker" data-target="#edit_end_date" />
                            <div class="input-group-append" data-target="#edit_end_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offset-md-1">
                    <div class="form-group">

                        <div class="form-group">
                            <div class="input-group date" id="edit_end_time" data-target-input="nearest">

                                <input type="text" name="edit_end_time" class="form-control datetimepicker-input"
                                    data-toggle="datetimepicker" data-target="#edit_end_time" />
                                <div class="input-group-append" data-target="#edit_end_time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>





        <div class="form-group row">
            <label for="type" class="col-2 col-form-label">Type</label>
            <div class="col-9">
                <select class="form-control " id="type" name="type">
                    <option></option>
                    <option value="0" {{$event->type == 0 ? 'Selected' : ''}}>Standard</option>
                    <option value="1"  {{$event->type == 1 ? 'Selected' : ''}}>Female Only</option>
                    <option value="2"  {{$event->type == 2 ? 'Selected' : ''}}>Men Only</option>
                </select>
            </div>
        </div>
        
        {{-- <div class="form-group row">
            <label for="endt_time" class="col-2 form-control-label">Event Start Date/Time</label>
            <div class="col-9">
                <div class="input-group">
                    <input type="text" name="start_time" class="form-control datetimepicker-input" id="end_time"
                        data-toggle="datetimepicker" data-target="#end_time" />
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fa fa-calendar-alt"></i></div>
                    </span>
                </div>
            </div>
        </div> --}}


        <div class="form-group row">
            <label for="limit" class="col-2 col-form-label">Male Limit</label>
            <div class="col-9">
            <input  class="form-control" name="limit" type="number" value="{{$event->limit}}" id="limit">
            </div>
        </div>

        <div class="form-group row">
                <label for="limit" class="col-2 col-form-label">Female Limit</label>
                <div class="col-9">
                    <input value="{{$event->f_limit}}"   class="form-control" name="f_limit" type="number" value="1" id="limit">
                </div>
            </div>


        <div class="form-group row">
            <label for="attendees" class="col-2 col-form-label">Women Age Range</label>
            <div class="col-9">
                <input data-from="{{$event->details->female_age_from}}" data-to="{{$event->details->female_age_to}}" value="" type="text" class="women_age_slider js-range-slider form-control" />
            </div>
        </div>

        <div class="form-group row">
            <label for="attendees" class="col-2 col-form-label">Men Age Range</label>
            <div class="col-9">
                <input data-from="{{$event->details->male_age_from}}" data-to="{{$event->details->male_age_to}}" type="text" class="men_age_slider js-range-slider  form-control" />
            </div>
        </div>



        <div class="form-group row">
            <label for="description" class="col-2 col-form-label">Description</label>
            <div class="col-9">
                <textarea class="form-control" name="description" id="description" rows="5">{{$event->description}}</textarea>

            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 form-control-label" for="email">Main Image</label>
            {{-- <input type="hidden" value="{{$event->main_image}}" name="filepath"> --}}
            <div class="col-md-9"> 
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fas fa-images"></i> Choose
                        </a>
                    </span>
                <input value="{{$event->main_image}}" id="thumbnail" class="form-control" type="text" name="filepath">
                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">
            </div>
            <!--col-->
        </div>

        {{-- Extras --}}



        <div class="form-group row">

            <label for="datetimes" class="col-md-2 col-form-label">Male Price</label>

            <div class="col-9">
            <input value="{{$event->price_male}}" class="form-control" type="number" name="price_male" id="male_price">

            </div>

        </div>

        <div class="form-group row">
            <label for="description" class="col-2 col-form-label">Female Price</label>
            <div class="col-9">
                <input value="{{$event->price_female}}" class="form-control" type="number" name="price_female" id="female_price">

            </div>
        </div>
         <div class="form-group row">
                        <label for="more" class="col-2 col-form-label">More</label>
                        <div class="col-9">
                          <textarea id="more" class="form-control" name="more">
                              
                          </textarea>
                      </div>
                    </div>

        <div class="form-group row">
            <label for="notes" class="col-2 col-form-label">Notes</label>
            <div class="col-9">
                <textarea class="form-control" name="notes" id="notes" rows="5">{{$event->notes}}</textarea>

            </div>
        </div>



        <input value="{{$event->details->male_age_to}}" type="hidden" name="male_age_to" id="male_age_to">
        <input value="{{$event->details->male_age_from}}" type="hidden" name="male_age_from" id="male_age_from">
        <input value="{{$event->details->female_age_to}}" type="hidden" name="female_age_to" id="female_age_to">
        <input value="{{$event->details->female_age_from}}" type="hidden" name="female_age_from" id="female_age_from">
        <div class="form-group row">
            <label for="description" class="col-2 col-form-label"></label>
            <div class="col-9">
                <button type="submit" class="btn btn-success float-right">Update</button><br><br>

            </div>
        </div>

    </form>