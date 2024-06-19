@extends('backend.layouts.app')

@push('after-styles')

@include('backend.events.includes.assets.styles')
@endpush
@section('title', app_name() . 'Events | Create' )

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Create Event

                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->




    <form method="post" action="{{ route('admin.event.store')}}">

            @csrf

            <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="company">Event Title</label>
    
                    <div class="col-md-9">
                        <input class="form-control" value="" type="text" name="title" id="organization" placeholder="Event Title"
                            maxlength="191" required="" autofocus="">
                    </div>
                    <!--col-->
                </div>
           


            


            <div class="form-group row">
                    <label for="address" class=" col-sm-2 col-form-label">Location</label>
                    <div class="col-md-9">
                        <input value="" class="form-control" name="address" placeholder="Location" type="text" id="address">
                    </div>
    
                </div>

            <div class="form-group">
                <div class="row">
            <label for="datetimes" class="col-md-2 col-form-label">Event Start Date/Time</label>

                <div class="col-md-4 ">
                <div class="form-group">
                        <div class="input-group date" id="start_date" data-target-input="nearest">
                        
                    <input name="start_date" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#start_date"/>
                    <div  class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-md-4 offset-md-1">
            <div class="form-group">

                <div class="form-group">
                        <div class="input-group date" id="start_time" data-target-input="nearest">
                        
                    <input type="text" name="start_time" class="form-control datetimepicker-input"  data-toggle="datetimepicker" data-target="#start_time"/>
                    <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
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
                <label for="end_date" class="col-md-2 col-form-label">Event End Date/Time</label>
    
                    <div class="col-md-4 ">
                    <div class="form-group">
                            <div class="input-group date" id="end_date" data-target-input="nearest">
                            
                        <input name="end_date" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#end_date"/>
                        <div  class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-md-4 offset-md-1">
                <div class="form-group">
    
                    <div class="form-group">
                            <div class="input-group date" id="end_time" data-target-input="nearest">
                            
                        <input type="text" name="end_time" class="form-control datetimepicker-input"  data-toggle="datetimepicker" data-target="#end_time"/>
                        <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fas fa-clock"></i></div>
                            </div>
                        </div> 
                    </div>
                </div>
                </div>
    
               
                    </div>
                </div>



                {{-- <div class="form-group row">
                        <label for="volunteers" class="col-2 col-form-label">Tags</label>
                        <div class="col-9">
                             <select id="tags" name="tags" class="form-control" name="influence" multiple="multiple">
                                    @foreach($tags as $value)
                             <option value="{{$value->name}}">{{$value->name}}</option>
                             
                             @endforeach
           
                        </select>
                        </div>
                    </div> --}}
                    {{-- {{$tags->name}} --}}
                    
                   

                    <div class="form-group row">
                        <label for="type" class="col-2 col-form-label">Type</label>
                        <div class="col-9">
                             <select  class="form-control " id="type" name="type" >
                            <option></option>
                            <option value="0">Standard</option>
                            <option value="1">Female Only</option>
                            <option value="2">Men Only</option>
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
                    <input value="" class="form-control" name="limit" type="number" value="1" id="limit">
                </div>
            </div>

            <div class="form-group row">
                    <label for="limit" class="col-2 col-form-label">Female Limit</label>
                    <div class="col-9">
                        <input value="" class="form-control" name="f_limit" type="number" value="1" id="limit">
                    </div>
                </div>
       
            <div class="form-group row">
                    <label for="attendees" class="col-2 col-form-label">Women Age Range</label>
                    <div class="col-9">
                        <input type="text" class="women_age_slider js-range-slider form-control" />
                    </div>
            </div>

            <div class="form-group row">
                    <label for="attendees" class="col-2 col-form-label">Men Age Range</label>
                    <div class="col-9">
                        <input type="text" class="men-age-slider form-control" />
                    </div>
            </div>

         

            <div class="form-group row">
                <label for="description" class="col-2 col-form-label">Description</label>
                <div class="col-9">
                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>

                </div>
            </div>

            <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="email">Main Image</label>
    
                    <div class="col-md-9">
                    <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fas fa-images"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="filepath">
                    </div>
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                    </div>
                    <!--col-->
                </div>

             {{-- Extras --}}
          
                    
            
                <div class="form-group row">
                    
                <label for="datetimes" class="col-md-2 col-form-label">Male Price</label>
    
                <div class="col-9">
                        <input class="form-control" type="number" name="price_male" id="male_price">
    
                    </div>
                   
                </div>

                <div class="form-group row">
                        <label for="description" class="col-2 col-form-label">Female Price</label>
                        <div class="col-9">
                           <input class="form-control" type="number" name="price_female" id="female_price">
        
                        </div>
                    </div>
                 <div class="form-group row">
                        <label for="more" class="col-2 col-form-label">More</label>
                        <div class="col-9">
                          <textarea id="more" class="form-control" name="more">
                              
                          </textarea>
                      </div>
                    </div>

                


            <input type="hidden" name="male_age_to" id="male_age_to">
            <input type="hidden" name="male_age_from" id="male_age_from">
            <input type="hidden" name="female_age_to" id="female_age_to">
            <input type="hidden" name="female_age_from" id="female_age_from">
            <div class="form-group row">
                <label for="description" class="col-2 col-form-label"></label>
                <div class="col-9">
                    <button type="submit" class="btn btn-success float-right">Submit</button><br><br>

                </div>
            </div>

        </form>
    </div>
    <!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-left text-muted">
                    <strong></strong>
                </small>
            </div>
            <!--col-->
            <div class="col text-right">
                <a class="btn btn-warning" href="">Back</a>
            </div>
        </div>
        <!--row-->
    </div>
    <!--card-footer-->
</div>
<!--card-->


@endsection
@push('after-scripts')
@include('backend.events.includes.assets.scripts')


<script>

(function() {
 var placesAutocomplete = places({
   appId: 'plW1BEH6EDNL',
   apiKey: '615e03b2ac995b93a451642711fb8510',
   container: document.querySelector('#address')
    }).configure({
    countries: ['ca']
    });
    })();
     $('select').select2({
            // theme: "bootstrap",
            // placeholder: "Search Value"
    });
    $('#lfm').filemanager('image');
    // Write JS to be passed to another file
    $(".js-range-slider").ionRangeSlider({
       type: "double",
       min: 18,
       max: 80,
       from: 18,
       to: 80,
       grid: true,
       skin: "round",
       onChange: function (data) {
        $("#female_age_from").val(data.from);
        $("#female_age_to").val(data.to);  
        }
   });

   $(".men-age-slider").ionRangeSlider({
       type: "double",
       min: 18,
       max: 80,
       from: 18,
       to: 80,
       grid: true,
       skin: "round",
       onChange: function (data) {
        $("#male_age_to").val(data.to);
        $("#male_age_from").val(data.from);
        }
   });

   
    var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    };
    
    CKEDITOR.replace( 'description', options);

    // Date 
    var dateNow = new Date();
    var timeNow = moment().format('LT');

    $('#start_date').datetimepicker({
            defaultDate: dateNow,
            minDate: dateNow,
            format: 'MM/DD/YYYY'
        });

        $('#start_time').datetimepicker({
            defaultDate: dateNow,
            format: 'LT'
        });

        $('#end_date').datetimepicker({
            defaultDate: dateNow,
            minDate: dateNow,
            format: 'MM/DD/YYYY'
        });

        $('#end_time').datetimepicker({
        defaultDate: dateNow,
        format: 'LT'
        });

        $("#start_date").on("change.datetimepicker", function (e) {
           $('#end_date').datetimepicker('minDate', e.date);
       });
       $("#end_time").on("change.datetimepicker", function (e) {
           $('#start_time').datetimepicker('maxDate', e.date);
       });
       
       $("#start_time").on("change.datetimepicker", function (e) {
           $('#end_time').datetimepicker('minDate', e.date);
       });
       $("#end_time").on("change.datetimepicker", function (e) {
           $('#start_time').datetimepicker('maxDate', e.date);
       });

</script>

@endpush