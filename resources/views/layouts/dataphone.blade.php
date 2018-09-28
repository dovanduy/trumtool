<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>GET OTP MOBI</title>
  <!-- BOOTSTRAP CORE STYLE  -->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONT AWESOME STYLE  -->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLE  -->
  <link href="assets/css/style.css" rel="stylesheet" />
  <!-- GOOGLE FONT -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
 <!-- MENU SECTION END-->
 <div class="content-wrapper">
   <div class="container">
     <div class="row">
      <div class="col-md-12">
        <div class="panel panel-info">
    <div class="panel-heading">
          GET OTP MOBI - TRUMTHE247
         </div>
         <div class="panel-body">
           <div class="form-group">
            <label>INPUT PHONE NUMBER</label>
            <input id="phone_number" class="form-control" type="text">
          </div>
          <button type="submit" id="getinfo" class="btn btn-info">[GET]</button>
        </div>
      </div>
      <div id="div_message" class="alert">

      </div>
      <div class="panel panel-info" id="result">
        <div class="panel-heading">
          RESULT 
        </div>
       <div class="panel-body">
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="infomation">
                      <div class="near_by_hotel_container">
                        <table class="table no-border custom_table dataTable no-footer dtr-inline">
                          <colgroup>
                            <col width="50%">
                            <col width="60%">
                          </colgroup>
                          
                          <tbody>
                            <tr>
                              <td>Phone Number</td>
                              <td class="text-center" id="isdn"></td>
                            </tr>
                            <tr>
                              <td>Tên khách hàng</td>
                              <td class="text-center" id="customerName"></td>
                            </tr>
                            <tr>
                              <td>Số hợp đồng</td>
                             <td class="text-center" id="contractId"></td>
                            </tr>
                            <tr>
                              <td>Loại hình thanh toán</td>
                             <td class="text-center" id="payMethodName"></td>
                            </tr>
                            <tr>
                              <td>Số tiền cần thanh toán</td>
                             <td class="text-center" id="totCharge"></td>
                            </tr>
                            
                          </tbody>
                        </table>
                      </div>
                    
                  </div>
                 

                </div>
              </div>
            </div>

  </div>
</div>
</div>
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
</body>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8">
  $( document ).ready(function() {
   

      $('#result').hide();

      $('#getinfo').click(function(){
        // $('#getinfo').attr("disabled", true);  

        showAlert("SUCCESS","Đang lấy thông tin vui lòng đợi...");
        var phonenumber = $('#phone_number').val().trim("");
        var phone = parseInt(phonenumber ,10)
        var result = checkinfo(phone);
      });
    });

  function showAlert(type,content) {
    if (type === "ERROR") {
      $("#div_message").removeClass("alert alert-info").addClass("alert alert-danger");
      $("#div_message").html(content);
    }else if (type === "SUCCESS") {
      $("#div_message").removeClass("alert alert-danger").addClass("alert alert-info");
      $("#div_message").html(content);
    }
  }
  function checkinfo(phonenumber){
     var base_url = window.location.origin +window.location.pathname;
     $('#result').hide();
    jQuery.ajax({
      dataType: "json",
      cache: false,
      type: "post",
      url: base_url + "/xuly.php",
      data: {
       phonenumber : phonenumber,
       action : "check"
      
     },
     success: function(res) {
   
        if(res.statuscode ==500){
             showAlert("ERROR","Thuê bao: " + phonenumber +" không thỏa mãn điều kiện hoặc sai. Vui lòng kiểm tra lại");
        }else if(res.statuscode ==200){
          showAlert("SUCCESS","Get thành công thuê bao: +84" + phonenumber);
           $('#result').show();
          parse(res);
        }
    },
           error: function(e, c, d) {

           },
         })
  }
  function parse(res){
      $('#contractId').text(res.contractId);
      $('#customerName').text(res.customerName);
      $('#isdn').text("+84" + res.isdn);
      $('#payMethodName').text(res.payMethodName);
      $('#totCharge').text(res.totCharge +" VND");

  }
</script>

</html>
