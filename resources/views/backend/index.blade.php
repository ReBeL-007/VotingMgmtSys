@extends('backend.layouts.master')

@section('title','Dashboard')

@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      
      
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <!-- Bar chart for available quantity-->
          <div class="box box-primary">
              <div class="box-header with-border">
                  <div class="box-body">
                      <div style=""></div>
                      <div id="institutional"
                          style="min-width: 310px; min-height: 550px; max-width: 1000px; margin: 0 auto"></div>
                  </div>
              </div>
              <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->
      <hr>
      <hr>
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <!-- Bar chart for available quantity-->
          <div class="box box-primary">
              <div class="box-header with-border">
                  <div class="box-body">
                      <div style=""></div>
                      <div id="individual"
                          style="min-width: 310px; min-height: 550px; max-width: 1000px; margin: 0 auto"></div>
                  </div>
              </div>
              <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  @endsection

  @section('scripts')
  <script src="{{ asset('public/backend/js/highcharts.js')}}"></script>
  {{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
  {{-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script> --}}
  <script>
  // Institutional votes bar chart
  Highcharts.chart('institutional', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Voting Results of Institutional Members'
      },            
      accessibility: {
          announceNewData: {
              enabled: true
          }
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: 'Total Votes'
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '{point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} votes</b> <br/>'
      },

      series: [
          {
              name: "Total Votes",
              colorByPoint: true,
              data: [ 
                      @foreach($institutional_votes as $total) 
                      {name: "{{$total->name}}", y: {{$total->cvotes}} },
                      @endforeach     
                   ]
          }
      ],
      
  });

  // Individual votes bar chart
  Highcharts.chart('individual', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Voting Results of Individual Members'
      },            
      accessibility: {
          announceNewData: {
              enabled: true
          }
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: 'Total Votes'
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '{point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} votes</b> <br/>'
      },

      series: [
          {
              name: "Total Votes",
              colorByPoint: true,
              data: [ 
                      @foreach($individual_votes as $total) 
                      {name: "{{$total->name}}", y: {{$total->cvotes}} },
                      @endforeach     
                   ]
          }
      ],
      
  });
  </script>
@endsection