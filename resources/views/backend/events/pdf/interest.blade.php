<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title></title>
    <style>
    </style>
  </head>
  <body>
      <h2>Calgary Speed Dating Men’s Profiles</h2>
      <hr>
      <p>
        <span style="margin-right: 50px;">www.CalgarySpeedDating.com</span>
        <span style="margin-right: 50px;">info@calgaryspeeddating.com</span>
        <span style="margin-right: 50px;">call/text: 403-219-3283</span>
      </p>
        @php
          $m_count=1;
          $f_count=1;
        @endphp
        @foreach ($males as $male)
          @if($male->profile->profile != '')
          <p> {{ $m_count++ }}. {{$male->first_name}}. Interest: {{ $male->profile->profile }}</p>
          @else
          <p> {{ $m_count++ }}. {{$male->first_name}}. International man of mystery</p>
          @endif
        @endforeach
      <div style="page-break-before: always;"></div>
      <h1>Calgary Speed Dating Women’s Profiles</h1>
      <hr>
      <p><span style="padding-right: 50px;">www.CalgarySpeedDating.com</span>
        <span style="padding-right: 50px;">info@calgaryspeeddating.com</span>
        <span style="padding-right: 50px;">call/text: 403-219-3283</span>
      </p>
      @foreach ($females as $female)
          @if($female->profile->profile != '')
          <p> {{ $f_count++ }}. {{$female->first_name}}. Interest: {{ $female->profile->profile }}</p>
          @else
          <p> {{ $f_count++ }}. {{$female->first_name}}. International women of mystery</p>
          @endif
        @endforeach
  </body>
</html>