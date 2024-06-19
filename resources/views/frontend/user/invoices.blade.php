@extends('frontend.includes.sidebar')
@section('side-content')
<div class="row justify-content-center align-items-center mb-3">
    <div class="col col-sm-10 align-self-center">

        <div class="card">
            <div class="card-header">
                <strong>
                    Invoices
                </strong>
            </div>

            <div class="card-body">


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Reference ID</th>
                            <th scope="col">Event</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>

                        </tr>
                    </thead>
                    <tbody>

                        {{-- // foreach ($payments as $pay) {
                        // // dd($pay->id);
                        // dd($request->user()->events->where('id', $pay->id)->pluck('title'));
                        // }
                        {{ date("F j, Y, g:i a", strtotime($reg->created_at)) }} --}}
                        {{-- {{$logged_in_user->events->whereIn('id', [1,2])}} --}}

                        @foreach ($payments as $pay)


                        <tr>
                            <th scope="row">{{$pay->stripe_id}}</th>

                            <td>
                                {{-- @foreach($logged_in_user->events->whereIn('id', $pay->id)->pluck('title') as
                                $event_title)
                                {{$event_title}}
                                @endforeach --}}
                                @foreach($logged_in_user->events->whereIn('id', $pay->event_id)->pluck('title') as
                                $event_title)
                                {{$event_title}}
                                @endforeach
                            </td>

                            <td>{{$pay->amount}}</td>
                            <td>{{ date("F j, Y, g:i a", strtotime($pay->created_at)) }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
