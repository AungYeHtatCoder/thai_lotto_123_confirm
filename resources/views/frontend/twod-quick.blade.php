@extends('user_layout.app')

@section('content')
@include('user_layout.sub_nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #ffffff;"
    >
        <div class="flesh-card">
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-between">
                    <span class="material-icons">account_balance_wallet</span>
                    <p class="px-2">လက်ကျန်ငွေ</p>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="material-icons">
                      update
                      </span>
                    <p class="px-2">ပိတ်ရန်ကျန်ချိန်</p>
                </div>
            </div>

            <div class="d-flex justify-content-between">

                <p class="ms-5">0.00</p>
                <p class="me-2">2023-11-16 <br/> 02:30:00PM</p>
            </div>
            
        </div>

        <div>
          <div class="d-flex justify-content-between custom-btn">
            <a href="dream-book.html" class="btn h-50 text-white p-2" style="background-color: #2a576c;"><span class="material-icons text-white icons">menu_book</span>  အိမ်မက်</a>
            <div class=""><h1>2D</h1></div>
            <select class="h-50 text-white">
              <option value="1">12:00 AM</option>
              <option value="2">04:00 PM</option>
            </select>
          </div>
        </div>

        <div class="d-flex justify-content-between mt-3 custom-btn">
          <button class="fs-6 px-3">ပတ်လည်</button>
          <input type="text" name="amount" id="amount" placeholder="ငွေပမာဏ" class="form-control w-50 text-center border-black"/>
        </div>
        

        <div class="d-flex justify-content-between mt-3 custom-btn">
          <a class="btn mt-3" data-bs-toggle="modal" data-bs-target="#colorModal"><span class="material-icons">
            question_mark
            </span>အရောင်ရှင်းလင်းချက်</a>
            
        </div>

        <div class="box-container mt-3" id="boxContainer">
          <div class="d-flex justify-content-around">
            <div class="box btn">
              00
              <div class="progress-bar mt-2"></div>
            </div>

            <div class="box btn">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box btn">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box btn">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box btn">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>    
          <div class="d-flex justify-content-around">
            <div class="box btn">
              00
              <div class="progress-bar mt-2"></div>
            </div>

            <div class="box btn">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box btn">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box btn">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box btn">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>
          <div class="d-flex justify-content-around">
            <div class="box btn">
              00
              <div class="progress-bar mt-2"></div>
            </div>

            <div class="box">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>
          <div class="d-flex justify-content-around">
            <div class="box">
              00
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>
          <div class="d-flex justify-content-around">
            <div class="box">
              00
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>
          <div class="d-flex justify-content-around">
            <div class="box">
              00
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>
          <div class="d-flex justify-content-around">
            <div class="box">
              00
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>
          <div class="d-flex justify-content-around">
            <div class="box">
              00
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>
          <div class="d-flex justify-content-around">
            <div class="box">
              00
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              01
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              02
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              03
              <div class="progress-bar mt-2"></div>
            </div>
            <div class="box">
              04
              <div class="progress-bar mt-2"></div>
            </div>
          </div>
        </div>

        <div class="dream-form mt-3">
            <div class="row">
               <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" id="zero" class="btn btn-primary">0</button>
                        <button type="button" id="one" class="btn btn-secondary">1</button>
                        <button type="button" id="two" class="btn btn-success">2</button>
                        <button type="button" id="three" class="btn btn-danger">3</button>
                        <button type="button" id="four" class="btn btn-warning">4</button>
                        <button type="button" id="five" class="btn btn-info">5</button>
                        <button type="button" id="six" class="btn btn-primary">6</button>
                        <button type="button" id="seven" class="btn btn-dark">7</button>
                        <button type="button" id="eight" class="btn btn-warning mt-1">8</button>
                        <button type="button" id="nine" class="btn btn-success mt-1">9</button>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <a href="https://thailotto123.net/admin/quick-odd-morning-play-two-d" class="btn btn-info btn-sm">မမ</a>
                        <a href="https://thailotto123.net/admin/quick-even-morning-play-two-d" class="btn btn-warning btn-sm">စုံစုံ</a>
                        <a href="https://thailotto123.net/admin/quick-odd-same-morning-play-two-d" class="btn btn-primary btn-sm">မမ အပူး</a>
                        <a href="https://thailotto123.net/admin/quick-even-same-morning-play-two-d" class="btn btn-warning btn-sm">စုံစုံ အပူး</a>
                    </div>
                </div>
               </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">အရောင်ရှင်းလင်းချက်</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-4">
                    <button id="one_amount" class="btn btn-outline-primary">150MMK</button>
                    </div>
                    <div class="col-4">
                    <button id="two_amount" class="btn btn-outline-secondary">200MMK</button>
                    </div>
                    <div class="col-4">
                    <button id="three_amount" class="btn btn-outline-success">250MMK</button>
                </div>
                
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <button id="four_amount" class="btn btn-outline-danger">300MMK</button>
                        </div>
                        <div class="col-4">
                        <button id="six_amount" class="btn btn-outline-warning">350MMK</button>
                        </div>
                    <div class="col-4">
                    <button id="seven_amount" class="btn btn-outline-info">500MMK</button>
                    </div>
                    
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <button id="eight_amount" class="btn btn-outline-dark">1000MMK</button>
                        </div>
                        <div class="col-4">
                            <button id="nine_amount" class="btn btn-outline-primary">1500MMK</button>
                        </div>
                    <div class="col-4">
                    <button id="ten_amount" class="btn btn-outline-secondary">2000MMK</button>
                    </div>
                    
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <button id="eleven_amount" class="btn btn-outline-success">2500MMK</button>
                        </div>
                        <div class="col-4">
                            <button id="twele_amount" class="btn btn-outline-danger">3000MMK</button>
                        </div>
                        <div class="col-4">
                            <button id="theen_amount" class="btn btn-outline-warning">5000MMK</button>
                        </div>
                    </div>
        
                    <form action="https://thailotto123.net/admin/quick-two-d-play" method="post" class="p-4">
                     <input type="hidden" name="_token" value="Kk6gDnv0C0gHjNm5XM6QB2HiyT3fXu9Qqrays0cM" autocomplete="off">    <!-- Selected Digits Input -->
                        <input type="text" id="outputField" name="selected_digits" class="form-control" placeholder="Selected digits">
                    
                        <div id="amuntInputs" class="col-md-12 mb-3"></div>
            
                        <div class="col-md-12 mb-3">
                            <label for="totalAmount">Total Amount</label>
                            <input type="text" id="totalAmount" name="totalAmount" class="form-control" readonly="">
                        </div>
        
                        <input type="hidden" name="user_id" value="6">
                    
                        <div class="col-12 d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-danger me-2">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
        
                </div>
            </div>
        </div>
        

    </div>

  </div>

<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">ထိုးမည့်အချိန် (section) ကိုရွေးပါ</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body">
    <div class="modal-btn">
     <a href="{{ url('/twodplay') }}" class="text-decoration-none btn">12:00 AM</a>
    </div>
    <div class="modal-btn mt-2">
     <a href="#" class="text-decoration-none btn">04:00 PM</a>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn modal-button">ထိုးမည်</button>
   </div>
  </div>
 </div>
</div>
{{-- @include('user_layout.footer') --}}
@endsection