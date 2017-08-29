<!--Newsletter Popup Start-->
  
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-body" style="text-align: center">
          <h4>Purchase: Red Sweat Pant suit</h4>
          <form id="buyer_request" method="post" action="#">
            <div class="content-subscribe">
             
              <div class="input-box">
              <label for="email">Product Name * :</label>
                <input type="text" class="input-text newsletter-subscribe" title="Sign up for our newsletter" name="buyerproduct" placeholder="product name:"> 
              </div>
              <div class="input-box">
              <label for="email">First Name* :</label>
                <input type="text" class="input-text newsletter-subscribe" title="Sign up for our newsletter" name="buyerfirstname" placeholder="first name:"> 
              </div>
               <div class="input-box">
               <label for="email">Last Name * :</label>
               <input type="text" class="input-text newsletter-subscribe" title="Sign up for our newsletter" name="buyerlastname" placeholder="last name:">
              </div>
               <div class="input-box">
               <label for="email">Phone Number * :</label>
                 <input type="text" class="input-text newsletter-subscribe" title="Sign up for our newsletter" name="buyerphonenumber" placeholder="Phone number:">
              </div>
               <div class="input-box">
               <label for="email">Buyer Email * :</label>
                <input type="text" class="input-text newsletter-subscribe" title="Sign up for our newsletter" name="buyeremail" placeholder="buyeremail:">
              </div>
              <div class="actions">
              <label for="email">Blog Author * :</label>
                <button name="backhome" class="button-subscribe" type="submit">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 
  <!--End of Newsletter Popup--> 
 <script type="text/javascript">
                            //alert('when clicked');
                              $(function(){
                                $( "#backhome" ).click(function(event)
                                  {
                                    $div_add_listing_type_error = $("#div_add_listing_type_error");
                                    $div_add_listing_type_success = $("#div_add_listing_type_success");

                                    //alert('when clicked'); 
                                    event.preventDefault();//prevent auto submit data
                                        var buyer_product= $("#buyer_product").val();
                                        var buyers_first_name= $("#buyers_first_name").val();
                                        var buyers_last_name= $("#buyers_last_name").val();
                                        var buyers_phone_number= $("#buyers_phone_number").val();
                                        var buyers_email= $("#buyers_email").val();
                                        
                                       

                                        //assign our rest of variables
                                        if (buyer_product == "" || buyer_product == null)
                                          {
                                                document.getElementById("buyerproduct").innerHTML="Enter the product name";
                                            
                                            
                                          } 
                                          else if (buyers_first_name == "" || buyers_first_name == null)
                                          {
                                                document.getElementById("buyerfirstname").innerHTML="Enter First Name";
                                            
                                            
                                          } 
                                        else if( buyers_last_name == "" || buyers_last_name == null)
                                          { 
                                                  document.getElementById("buyerlastname").innerHTML="Enter Last Name";
                                          }
                                        else if (buyers_phone_number == "" || buyers_phone_number == null)
                                          {
                                                  document.getElementById("buyerphonenumber").innerHTML="Enter Phone Number";
                                          }
                                        else if (buyers_email == "" || buyers_email == null){
                                                  document.getElementById("buyeremail").innerHTML="Enter buyer Email";
                                          }
                                       
                                      
                                        else{         
                                          $.ajax({
                                          type:"post",
                                          url: base_url + "home/insert_buyer_detail",//URL changed 
                                          data:{ 
                                            'buyer_product':buyer_product,
                                            'buyers_first_name':buyers_first_name, 
                                            'buyers_last_name':buyers_last_name,
                                            'buyers_phone_number':buyers_phone_number,
                                            'buyers_email':buyers_email},
                                            


                                      success:function(data){                   

                                                     if(data.status == 'ERROR'){
                                                            document.getElementById("success").innerHTML="Saving Failed !!";
                                                          }

                                                      else{ 
                                                            document.getElementById("error").innerHTML="Saved Successfully";
                                                          }
                                                        } 
                                                      }); 
                                                    $('#buyer_request').each(function(){
                                                      this.reset();
                                                    });
                                                    /*$("#blog_content").val('');*/
                                                }
                                              });
                                          });
                          </script> 