
<div class="left">
	 
<!-- sidebar here with div class leftmenu -->

</div>
<div class="right">
	<h1 class="sitetitle"><?php echo $details->title ?></h1>
	
<div class="content">
	<div style="margin-top: 40px;"></div>
	<div class="stab">
       <ul>
       	<li><span style="color:#000;font-weight: bold;">Office Phone:</span><span style="color:#009F4D;font-weight: bold;"> +255 222 761 811 </span></li>
       	<li><span style="color:#000;font-weight: bold;">Fax:</span><span style="color:#009F4D;font-weight: bold;"> +255 222 761 812 </span></li>
       	<li><span style="color:#000;font-weight: bold;">Mobile:</span> <span style="color:#009F4D;font-weight: bold;"> +255 784 885 901 </span></li>
       	<li><span style="color:#000;font-weight: bold;">Skype(ID:XXXXXX):</span><span style="color:#009F4D;font-weight: bold;"> johndoe</span></li> 
       	<!-- <li><span style="margin-top: -24px;margin-left: 200px;"> <img src="images/skype.png" alt=""></span></li> -->
       </ul>

 </div>
 <p>Please use the form below to inquire about our tours, overnight packages or to ask 
 	about a custom itinerary designed just for you.</p>

 <form class="contact_form" action="#" method="post" name="contact_form">
    
        <p class="denotes">			
             
             <span class="required_notification">* Denotes Required Field</span>
        </p>  <br>
          <p class="name">	
            <label for="name">Name:</label><br>
            <input type="text"  placeholder="John Doe" required />
        </p>
          <p class="email">	
            <label for="email">Email:</label><br>
            <input type="email" name="email" placeholder="john_doe@example.com" required />
            <span class="form_hint">Proper format "name@something.com"</span>
         </p>
          <p class="email_confirm">	
        
            <label for="email"> Please Confirm Your Email Address:</label><br>
            <input type="email" name="email" placeholder="john_doe@example.com" required />
            <span class="form_hint">Proper format "name@something.com"</span>
        </p>
          <p class="phone">	
            <label for="phone">Phone Number:</label><br>
            <input type="phone" name="phone" placeholder="Phone Number" />
            <span class="form_hint">Proper format "Start with your country code"</span>
        </p>
         <p class="expected">	
            <label for="expected">Expected Date of Arrival:</label><br>
            <input type="expected" name="expected" id="expected" placeholder="Enter Expected Date of Arrival (if known)" />
            <!-- <span class="form_hint">Proper format "DD/MM/YY"</span> -->
        </p>  
        <p class="uexpected">	
            <label for="uexpected">Expected Date of Depature:</label><br>
            <input type="uexpected" name="expected" id="uexpected"  placeholder="Enter Expected Date of Depature(if known)" />
            <!-- <span class="form_hint">Proper format "DD/MM/YY"</span> -->
        </p> 
        <p class="number_people">	
            <label for="number_people">Number of People:</label><br>
            <input type="number_people" name="number_people" placeholder="Enter Number of People" />
            <span class="form_hint">Proper format "Use numeric values, eg: 12 "</span>
        </p>
          <p class="rooms">	
            <label for="rooms">Number and Type of Rooms Required:</label><br>
            <textarea name="rooms" cols="40" rows="6" ></textarea>
        </p>
       <!--  <p class="desired_accomodation">	
            <label for="desired_accomodation">Desired Accomodation:</label><br>
           <select>
			<option value="Moderate">Moderate</option>
			<option value="luxury">Luxury</option>
			<option selected="selected" value="budget">Budget</option>
			</select>

        </p>  -->
        <p class="approx_budget">	
            <label for="approx_budget">Approximated Budget:</label><br>
            <input type="approx_budget" name="approx_budget" placeholder="Enter Your Approximated Budget" />
            <span class="form_hint">Proper format "eg: $120"</span>
        </p>
        <p class="subject">	
            <label for="subject">Subject:</label><br>
            <input type="subject" name="subject" placeholder="Enter The Subject"  required <?php if(isset($subject)) echo 'value="' . ucwords($subject) . '"' ?>/>
           <!--  <span class="form_hint">Proper format " "</span> -->
        </p> 
          <p class="interests">	
            <label for="interests">Tell Us About Your Interests:</label><br>
            <textarea name="rooms" cols="40" rows="6" required></textarea>
        </p>
         <p class="captcha">	
            <input type="captcha" name="captcha" placeholder="" />
            <p  class="contact_teaser">Please Prove That You Are Human By Entering The Characters In An Image Above</p>
        </p> 
        <p class="captcha2">	
            <input type="captcha2" name="captcha2" placeholder="" required />

        </p>
          <p>	
        	<button class="submit" type="submit">Submit Form</button>
        </p>
    
</form>

 












</div></div></div>

<script>
$(function() {
        $( "#expected,#uexpected" ).datepicker();
    });

</script>
