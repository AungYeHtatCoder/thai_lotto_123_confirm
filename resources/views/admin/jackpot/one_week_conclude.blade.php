@extends('layouts.admin_app')
@section('styles')
    <style>
        .transparent-btn {
            background: none;
            border: none;
            padding: 0;
            outline: none;
            cursor: pointer;
            box-shadow: none;
            appearance: none;
            /* For some browsers */
        }

@font-face {
    font-family: 'Myanmar Pyidaungsu';
    src: url('{{ asset('assets/css/Pyidaungsu.ttf') }}') format('truetype');
    font-weight: normal;
    font-style: normal;
}

.table-font-myanmar {
    font-family: 'Pyidaungsu', sans-serif;
}
</style>

@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">အောက်နှစ်လုံးထီ တပါတ်အတွင်းထိုးထားသော စာရင်း ပေါင်းချုပ် -   Dashboards
                                <span>
                                     {{-- <h6></h6> --}}
                                </span>
                                <span>
                                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                
                                <a class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1"
                                    href="{{ url('/admin/once-week-jackpot-list') }}" >Back</a>
                            </div>
                        </div>
                                </span>
                            </h5>

                        </div>
                       
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                    type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
   <div class="table-responsive">
   
       <table class="table table-flush" id="twod-search">
           <thead class="thead-light">
                <tr>
                <th>No</th>
                <th>အောက်နှစ်လုံးထီ</th>
                <th>ထိုးကြေး</th>
                <th>ရက်စွဲ</th>
                <th>Win/Lose</th>
                </tr>
           </thead>
            <tbody>
        @if(isset($lotteries))
        <p class="text-center text-white px-3 py-2 mt-3" style="background-color: #c50408">
          ကံစမ်းထားသော အောက်နှစ်လုံးထီဂဏန်းများ -    Lottery Match Times for {{ Carbon\Carbon::now()->format('F Y') }}
          {{-- <span>
            <a href="{{ url('/user/jackport-play')}}" style="color: #f5bd02; text-decoration:none">
              <strong>ထီးထိုးရန် နိုပ်ပါ</strong></a>
          </span> --}}
        </p>
        @endif

       @foreach ($lotteries as $lottery)
    <tr>
        <td>{{ $lottery->jackpot_id }}</td>
        <td>{{ $lottery->two_digit }}</td>
        <td>
            @if($lottery->currency == 'mmk')
                {{ $lottery->sub_amount / $currencyRate }} bath
            @else
                {{ $lottery->sub_amount }} bath
            @endif
        </td>
        <td>{{ \Carbon\Carbon::parse($lottery->lotto_created_at)->format('d-m-Y (l) (h:i a)') }}</td>
        <td>{{ $lottery->prize_sent ? 'Win' : 'Pending' }}</td>
    </tr>
@endforeach

      </tbody>
       </table>
        <div class="mb-3 d-flex justify-content-around text-white p-2 shadow border border-1" style="border-radius: 10px; background: var(--Primary, #12486b)">
      <p class="text-end pt-1" style="color: #fff">Total Amount in Baht: ||&nbsp; &nbsp; 
    <strong>{{ number_format($totalSubAmountBaht, 2) }} Baht</strong>
</p>

    </div>
   </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
    {{-- <script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
  </script> --}}
    <script>
        if (document.getElementById('twod-search')) {
            const dataTableSearch = new simpleDatatables.DataTable("#twod-search", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
            });

            document.querySelectorAll(".export").forEach(function(el) {
                el.addEventListener("click", function(e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "material-" + type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = ",";
                    }

                    dataTableSearch.export(data);
                });
            });
        };
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
