@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
 @if(\Illuminate\Support\Facades\Auth::user()->type == 'beta')
 

<div class="row">
        <div class="col-lg-4">
            <div class="btn card card-chart">
                
                <div class="card-header">
                <a href="{{route('user.index')}}">
                    <h5 class="card-category text-primary">Total Merchants</h5>
                    <h3 class="card-title counter"><i class="tim-icons icon-single-02 text-primary"></i> {{$merchant}}</h3>
                </a>
                </div>
            </div>
        </div>
        <div class=" col-lg-4">
            <div class="btn card card-chart">
                <div class="card-header">
                    <a href="{{route('profile.edit')}}">
                    <h3 class="card-category text-info">Total Clients</h3>
                    <h3 class="card-title counter"><i class="tim-icons icon-single-02 text-info"></i>{{$client}}</h3>
                    </a>
                </div>
            </div>
        </div>
        <div class=" col-lg-4">
            <div class="btn card card-chart">
           
                
                <div class="card-header">
               
                    <h5 class="card-category text-success">Total Users</h5>
                    <h3 class="card-title counter"><i class="tim-icons icon-send text-success"></i>{{$merchant+$client}}</h3>
              
                </div>
                

            </div>
        </div>
        <div class=" col-lg-4">
            <div class="btn card card-chart">
           
                <a href="{{ route('getTransactions') }}">
                <div class="card-header">
                 
                    <h5 class="card-category text-warning">Total Transections</h5>
                    <h3 class="card-title counter"><i class="tim-icons icon-chart-bar-32 text-warning"></i>{{$Transection}}</h3>
                 
                </div>
                </a>

            </div>
        </div>
    </div>
@endif
 @if(\Illuminate\Support\Facades\Auth::user()->type == 'alpha')
<div class="row">
        <div class="col-lg-4">
            <div class="btn card card-chart">
                
                <div class="card-header">
                <a href="{{route('getTransactionsalpha')}}">
                    <h5 class="card-category text-success">Total Transections</h5>
                    <h3 class="card-title counter"><i class="tim-icons icon-chart-bar-32 text-success"></i> {{$merchant_Transection}}</h3>
                </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {demo.initDashboardPageCharts();});
        
        
        
//      const counters = document.querySelectorAll('.counter');
// const speed = 2; // The lower the slower

// counters.forEach(counter => {
//     const updateCount = () => {
//         const target = +counter.getAttribute('data-target');
//         const count = +counter.innerText;

//         // Lower inc to slow and higher to slow
//         const inc = target / speed;

//         console.log(inc);
//         console.log(count);

//         // Check if target is reached
//         if (count < target) {
//             // Add inc to count and output in counter
//             counter.innerText = count + inc;
//             // Call function every ms
//             setTimeout(updateCount, 1);
//         } else {
//             counter.innerText = target;
//         }
//     };

//     updateCount();
// });
        
    </script>
@endpush
