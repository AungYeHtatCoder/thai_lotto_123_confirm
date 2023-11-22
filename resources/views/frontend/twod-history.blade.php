@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; height: 120vh">
  <div class="two-history-results mt-3 mx-auto">
   <p class="text-center pt-4 fw-bold" style="font-size: 4rem;">71</p>
  </div>

  <div class="container mt-3 mb-4" style="padding-bottom: 130px;">
   <div class="card text-center p-0 cards" style="background-color: #2a576c">
    <div class="card-body">

     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>AM</p>
       <p>BTC</p>
       <p>ETH</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>09:30</p>
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>

   <div class="card text-center p-0 cards mt-3" style="background-color: #2a576c">
    <div class="card-body">

     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>AM</p>
       <p>BTC</p>
       <p>ETH</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>09:30</p>
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>

   <div class="card text-center p-0 cards mt-3" style="background-color: #2a576c">
    <div class="card-body">

     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>AM</p>
       <p>BTC</p>
       <p>ETH</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>09:30</p>
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>
   <div class="card text-center p-0 cards mt-3" style="background-color: #2a576c">
    <div class="card-body">

     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>AM</p>
       <p>BTC</p>
       <p>ETH</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>09:30</p>
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>
  </div>


 </div>

</div>

@include('user_layout.footer')
@endsection

@section('script')
<script>
    async function fetchData() {
      const url = 'https://shwe-2d-live-api.p.rapidapi.com/live';
      const options = {
        method: 'GET',
        headers: {
          'X-RapidAPI-Key': '4c6bcd02e8msh0665010fc0fab0fp1a2d33jsn173e389166b3',
          'X-RapidAPI-Host': 'shwe-2d-live-api.p.rapidapi.com'
        }
      };

    await fetch(url, options)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const updatedTime = new Date(data.live.time);
        const day = updatedTime.getDate().toString().padStart(2, '0');
        const month = (updatedTime.getMonth() + 1).toString().padStart(2, '0');
        const year = updatedTime.getFullYear();
        let hours = updatedTime.getHours();
        const minutes = updatedTime.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        const updatedTimeFormat = `${day}-${month}-${year} ${hours}:${minutes.toString().padStart(2, '0')}:${updatedTime.getSeconds().toString().padStart(2, '0')}${ampm}`;

        $("#live_2d").text(data.live.twod);
        $("#live_updated_time").text(updatedTimeFormat);

        let newHTML = '';
        data.result.forEach(r => {
            newHTML += `
                    <div class="card digit-card mb-1">
                        <p class="text-center">${r.open_time}</p>
                        <div class="multi-text">
                            <div class="">
                                <p>Set</p>
                                <p>${r.set}</p>
                            </div>
                            <div class="">
                                <p>Value</p>
                                <p>${r.value}</p>
                            </div>
                            <div class="">
                                <p>2D</p>
                                <p>${r.twod}</p>
                            </div>
                        </div>
                    </div>
                            `;
                    });
                    $('#result').html(newHTML);
            })
            .catch(error => {
                        console.error('Error:', error);
                    });
            };
            fetchData();
  //   setInterval(fetchData, 1000);
  </script>
@endsection
