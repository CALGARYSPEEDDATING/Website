@if(isset($results) || isset($message) )
                <div class="row">
                        <div class="col-12 text-center">
                <a style="cursor:pointer"  href="{{ route('admin.event.index')}}"" class="btn btn-warning btn-lg"><i class="fas fa-sync-alt"></i></a>
                        </div>
                </div>
                @else
                {{-- {{ route('admin.event.search')}} --}}
                <form action="{{ route('admin.event.search')}}" method="post" class="events-filter">
                    {{ csrf_field() }}
                   
          

                     <div class="form-group row">
                            
                            <div class="col-md-12">
                                <input value=""  class="form-control" name="keywords" placeholder="Search By Title" type="text" id="keywords">
                            </div>
                    
                        </div>
                        <div class="row">
                                <div class="form-group col-sm-6">
                                  {{-- <label for="city">Status</label> --}}
                                  <select class="form-control" id="status" name="status">
                                        <option selected disabled>Select Status</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Enabled</option>
                                        <option value="2">Canceled</option>
                                      </select>
                                </div>
                                <div class="form-group col-sm-6">
                                  {{-- <label for="postal-code">Staus</label> --}}
                                  <select class="form-control" id="time_period" name="time_period">
                                        <option selected disabled>Time Period</option>
                                        <option value="past">Past</option>
                                        <option value="upcoming">Upcoming</option>
                                        <option value="today">Today</option>
                                       
                                      </select>
                                </div>
                              </div>
                       <div class="form-group select-style">
                       {{-- <label for="dateposted">Date Posted:</label> --}}
                       <select class="form-control" name="date_posted">
                     <option selected disabled>Date Submitted</option>
                     <option value="{{\Carbon\Carbon::yesterday()->toDateString()}}|1 Day Ago">1 Day Ago </option>
                     <option value="{{\Carbon\Carbon::now()->subDay(2)->toDateString()}}|2 Days Ago">2 Days Ago </option>
                     <option value="{{\Carbon\Carbon::now()->subDay(7)->toDateString()}}|1 Week Ago">1 Week Ago </option>
                     <option value="{{\Carbon\Carbon::now()->subDay(14)->toDateString()}}|2 Weeks Ago">2 Weeks Ago</option>
                   </select>
                     </div>
                     {{-- <button type="submit" class="btn-custom center-block">Filter</button> --}}
                     <button style="cursor:pointer" type="submit"  class="btn btn-primary btn-lg btn-block">Filter</button>
                    
                   </form>
       <br><br>
       @endif