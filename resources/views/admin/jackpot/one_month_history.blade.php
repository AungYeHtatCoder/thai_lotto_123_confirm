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
                            <h5 class="mb-0">အောက်နှစ်လုံးထီ ပေါင်းချုပ် စာရင်း  Dashboards
                                <span>
                                     <h6>အောက်နှစ်လုံးထီ  Lottery Match Times for {{ Carbon\Carbon::now()->format('F Y') }}</h6>
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
            <th>#</th>
            {{-- <th>Two Digit ID</th> --}}
            <th>Two Digit</th>

            <th>Sub Amount</th>
            <th>Prize Sent</th>
            {{-- <th>Pay Amount</th>
            <th>Total Amount</th> --}}
            <th>User Name</th>
            <th>Created At</th>
           </thead>
           <tbody>
            @foreach($history as $record)
             <tr>
              <td>{{ $loop->index + 1 }}</td>
              {{-- <td>{{ $record->two_digit_id }}</td> --}}
              <td>{{ $record->two_digit }}</td>
              <td>{{ $record->sub_amount }}</td>
              <td>
                @if($record->prize_sent == 1)
                <span class="badge badge-success">လျော်ပြီး</span>
                @else
                <span class="badge badge-danger">မလျော်ရသေး</span>
                @endif
              </td>

              {{-- <td>{{ $record->pay_amount }}</td>
              <td>{{ $record->total_amount }}</td> --}}
              <td>{{ $record->user_name }}</td> <!-- Display the user name -->
              <td>{{ $record->created_at }}</td>
             </tr>
            @endforeach
           </tbody>
       </table>
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
