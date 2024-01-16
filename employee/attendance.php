<!-- opening head & body tags in head.php -->
<?php include_once "../includes/head.php"; ?>

<!-- inside body -->

<div class="wrapper">

    <!-- Navbar -->
    <?php include_once "../includes/navigation.php"; ?>

    <!-- Main Sidebar Container -->
    <?php include_once "../includes/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Content Header Breadcrumbs -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employee Attendance</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Attendace</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



        <!-- Main content -->
        <div class="content">
           <div class="container-fluid">
               <div class="row" style="align-items: center;">
                     <div class="card" style="width:500px ; margin-left: 30%; padding: 23px;">
                            <div class="card-header">
                                <h5 class="m-0">Attendance Card & Break Card</h5>
                            </div>
                            
                      
                        <div class="row mt-2">
                            <div class="col-sm-6">
                             <div class="form-check">
                                        <input class="form-check-input" type="radio" value="chckIn-chekcout" name="chckIn-chekcout" id="chckIn-chekcout" checked>
                                          <label class="form-check-label" for="chckIn-chekcout">
                                            Check In Check Out                                                                  
                                        </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check " id="div2">
                                        <input class="form-check-input" type="radio" value="break" name="chckIn-chekcout" id="break" >
                                          <label class="form-check-label" for="break">
                                            Break                                                                 
                                        </label>
                                </div>
                            </div>
                        </div>
                        <hr> 

                        <div class="checkout-div">

                                <form id="form-check">
                                 <input type="hidden" name="cmd" value="attendance-save">
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" value="check-in" name="check-in" id="check1">
                                          <label class="form-check-label" for="check1">
                                            Check In                                                                 
                                        </label>
                                </div>
                   
                           
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" value="check-out" name="check-in" id="check2" >
                                  <label class="form-check-label" for="check2">
                                    Chekc Out
                                  </label>
                                   <div id = "clock" onload="currentTime()" style="margin-left: 350px;
                                    margin-top: -33px;"></div>
                                </div> 
                               
                                  <div class="col-4">
                                   
                                    <button type="submit" class="btn btn-primary mt-5 attendace-submit" >Submit</button>
                                </div>
                            </form> 
                            </div> 
                       
                        
                             <div class="break-div" style="display: none;">
                                 <form id="form-break-check">
                                 <input type="hidden" name="cmd" value="lunch-break">
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" value="break-start" name="break-start" id="check3">
                                          <label class="form-check-label" for="check3">
                                            Break Start                                                                
                                        </label>
                                </div>
                   
                           
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" value="break-end" name="break-start" id="check4" >
                                  <label class="form-check-label" for="check4">
                                     Break End
                                  </label>
                                   <div id = "clock2" onload="currentTime()" style="margin-left: 350px;
                                    margin-top: -33px;"></div>
                                </div> 
                               
                                  <div class="col-4">
                                   
                                    <button type="submit" class="btn btn-primary mt-5 attendace-break-submit" >Submit</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <?php include_once "../includes/footer.php"; ?>



</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include_once "../includes/scripts.php"; ?>


<!-- additional script goes here -->

<script type="text/javascript">

                function currentTime() {
              let date = new Date(); 
              let hh = date.getHours();
              let mm = date.getMinutes();
              let ss = date.getSeconds();
              let session = "AM";

                
              if(hh > 12){
                  session = "PM";
               }

               hh = (hh < 10) ? "0" + hh : hh;
               mm = (mm < 10) ? "0" + mm : mm;
               ss = (ss < 10) ? "0" + ss : ss;
                
               let time = hh + ":" + mm + ":" + ss + " " + session;

              document.getElementById("clock").innerText = time; 
              document.getElementById("clock2").innerText = time; 
              let t = setTimeout(function(){ currentTime() }, 1000); 

            }

            currentTime();


            $(".attendace-submit").on('click' , function(){

                 $('.page-loading').show();
             var data = $("#form-check").serialize();
             $.post("../ajax.php",data,function(res){
                // Metronic.stopPageLoading();
                $('.page-loading').hide();
               var obj = JSON.parse(res);
               console.log(obj)
            if(obj.error == "false")
            {
                $(".success_span").text(obj.msg);

                $(".alert-success").show();
                //window.location = "index.php";
            }else
            {
                $(".error_span").text(obj.msg);

                $(".alert-danger").show();
            }
            });

            return false;

            });

             $(".attendace-break-submit").on('click' , function(){

                 $('.page-loading').show();
             var data = $("#form-break-check").serialize();
             $.post("../ajax.php",data,function(res){
                // Metronic.stopPageLoading();
                $('.page-loading').hide();
               var obj = JSON.parse(res);
               console.log(obj)
            if(obj.error == "false")
            {
                $(".success_span").text(obj.msg);

                $(".alert-success").show();
                //window.location = "index.php";
            }else
            {
                $(".error_span").text(obj.msg);

                $(".alert-danger").show();
            }
            });

            return false;

            });

             $(document).ready(function(){
                $("#chckIn-chekcout").click(function(){
                 
                  $(".checkout-div").show();
                  $(".break-div").hide();
                });
                $("#break").click(function(){
                  $(".checkout-div").hide();
                   $(".break-div").show();
                   //$(".heelo-div").css('display','');
                  
                });
            });
</script>
</body>
</html>
<!-- ./closing body & head -->