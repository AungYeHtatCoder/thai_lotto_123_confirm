@extends('user_layout.app')
@section('style')
<style>
 .table tr th,
 .table td {
  color: #fff;
  background-color: #265166;
  padding: 16px;
  /* Adjust the padding to change the space between columns and rows */
  border: 1px solid #fff;
  /* Set the border to transparent */
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
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; height: auto">
  <div class="w-100 text-center text-white p-4 rounded" style="background-color: #265166; height: 200px;">
   <p style="font-weight: 800;font-size: 3.5rem;" id="3d_live"></p>
   <div>
    <small class="fw-bold" id="updatedTime"></small>
   </div>
  </div>

  <div class="mt-4" style="padding-bottom: 200px;">
    <div id="3d_result"></div>
  </div>


 </div>

</div>

@include('user_layout.footer')
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    async function fetchData() {
      const url = 'https://shwe-2d-live-api.p.rapidapi.com/3d-live';
      const options = {
        method: 'GET',
        headers: {
          'X-RapidAPI-Key': '4c6bcd02e8msh0665010fc0fab0fp1a2d33jsn173e389166b3',
          'X-RapidAPI-Host': 'shwe-2d-live-api.p.rapidapi.com'
        }
      };

      try {
        const response = await fetch(url, options);
        const result = await response.json();

        let originalString = result[0].date;
        let dateString = originalString;
        let dateObj = new Date(dateString.replace(/(\d{2})\/(\w{3})\/(\d{4})/, '$2 $1, $3'));
        let formattedDate = dateObj.toISOString().split('T')[0];
        let days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        let dayOfWeek = days[dateObj.getDay()];
        let updatedTime = `${dateString} (${dayOfWeek})`;
        // console.log(updatedTime);

        $("#updatedTime").text(updatedTime);
        $("#3d_live").text(result[0].num);

        // console.log(result[0].num);
        let newHTML = '';
        result.forEach(r => {
            newHTML += `
                <div class="d-flex justify-content-between align-items-center px-3 py-2 my-2" style="border-bottom: 1px solid #265166 ;">
                    <p>${r.date}</p>
                    <p class="fw-bold">${r.num}</p>
                </div>
                        `;
        });
        $('#3d_result').html(newHTML);


        console.log(result);
      } catch (error) {
        console.error(error);
      }
    }
    fetchData();
</script>
@endsection
