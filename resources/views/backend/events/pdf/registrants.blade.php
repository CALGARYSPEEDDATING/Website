<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>Name</b></td>
        <td><b>Paid</b></td>
        <td><b>#</b></td>
        <td><b>√</b></td>
        <td><b>Birth Date</b></td>
        <td><b>Gender</b></td>
        <td><b></b></td>
      </tr>
      </thead>
      <tbody>

        @php
          $female_count=1;
          $male_count=1;
        @endphp
        @foreach ($females as $female)
        <tr>
          <td> {{ $female_count++ }}. {{ $female->first_name }}</td>
          <td> {{ $female->pivot->paid !=0 ? 'Yes': 'No' }} &nbsp;</td>
          <td> &nbsp;</td>
          <td> &nbsp;</td>
          <td> {{ \Carbon\Carbon::parse($female->dob)->format('jS  F, Y') }}</td>
          <td> {{$female->profile->gender == 1 ? 'Female' : 'Male'}}</td>
          <td> {{ $female->phone }}</td>
        </tr>
        @endforeach
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td> &nbsp;</td>
          <td> &nbsp;</td>
          <td> &nbsp;</td>
          <td> &nbsp;</td>
          <td> &nbsp;</td>
        </tr>
        @foreach ($males as $female)
        <tr>
          {{-- {{substr($female->last_name, 0, 1)}} --}}
          <td> {{ $male_count++ }}. {{ $female->first_name}}</td>
          <td> {{ $female->pivot->paid !=0 ? 'Yes': 'No' }} &nbsp;</td>
          <td> &nbsp;</td>
          <td> &nbsp;</td>
          <td> {{ \Carbon\Carbon::parse($female->dob)->format('jS  F, Y') }}</td>
          <td> {{$female->profile->gender == 1 ? 'Female' : 'Male'}}</td>
          <td> {{ $female->phone }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>