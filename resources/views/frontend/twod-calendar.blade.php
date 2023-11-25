@extends('user_layout.app')
@section('style')
<style>
 .table tr th,
 .table td {
  color: #fff;
  background-color: #265166;
  padding: 16px;

 }

 .custom-tables>.table tr>td,
 .table tr>td>a {
  color: white;
 }
</style>
@endsection
@section('content')
@include('user_layout.nav')
<div class="row">
    <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 pt-2" style="background-color: #b6c5d8; height: auto; padding-bottom: 1000px">
        <p class="text-center fs-4 fw-bold mt-3 text-secondary">2D Calendar</p>
        <div id="2dCalender"></div>
    </div>

</div>

@include('user_layout.footer')
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    async function fetchData() {
      const url = 'https://shwe-2d-live-api.p.rapidapi.com/calender';
      const options = {
        method: 'GET',
        headers: {
          'X-RapidAPI-Key': '53aaa0f305msh5cdcf7afaacaedcp11a2d2jsn2453bc4f2507',
          'X-RapidAPI-Host': 'shwe-2d-live-api.p.rapidapi.com'
        }
      };

      try {
        const response = await fetch(url, options);
        const result = await response.json(); // Parse the response as JSON
        const calendar = result.message;
        // console.log(calendar);

                let newHTML = '';
                    calendar.forEach(r => {
                        let originalString = r.update;
                        let dateString = originalString.split(':')[1].trim().split(' ')[0];
                        let dateObj = new Date(dateString.replace(/(\d{2})\/(\w{3})\/(\d{4})/, '$2 $1, $3'));
                        let formattedDate = dateObj.toISOString().split('T')[0];
                        let days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                        let dayOfWeek = days[dateObj.getDay()];
                        let updatedTime = `${dateString} (${dayOfWeek})`;
                        // console.log(dateString);

                        newHTML += `
                        <p class="text-center fw-bold custom-tables">${updatedTime}</p>
                        <table class='table text-center mb-1 pb-'>
                            <tr class='text-center'>
                                <th>Time</th>
                                <th>Internet</th>
                                <th>Modern</th>
                            </tr>
                            <tr>
                                <td>9:30AM</td>
                                <td>${r.a9_internet}</td>
                                <td>${r.a9_modern}</td>
                            </tr>
                            <tr>
                                <td>2:00PM</td>
                                <td>${r.a2_internet}</td>
                                <td>${r.a2_modern}</td>
                            </tr>
                        </table>
                        <table class="table table-transparent mt-0 pt-0">
                            <tr class='text-center'>
                                <th>Time</th>
                                <th>BTC</th>
                                <th>ETH</th>
                                <th>2D</th>
                            </tr>
                            <tr>
                                <td>12:00PM</td>
                                <td>${r.a12_set}</td>
                                <td>${r.a12_value}</td>
                                <td>${r.a12_result}</td>
                            </tr>
                            <tr>
                                <td>4:30PM</td>
                                <td>${r.a43_set}</td>
                                <td>${r.a43_value}</td>
                                <td>${r.a43_result}</td>
                            </tr>
                        </table>
                        `;
                    });
                $('#2dCalender').html(newHTML);

        console.log(calendar);
      } catch (error) {
        console.log(error);
      }
    }
    fetchData();
</script>
@endsection
