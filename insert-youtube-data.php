<?php include "header.php"; ?>
<?php
if($_SESSION['admintype'] == '3'){
    header("Location: dashboard.php");
}

?>
<?php //header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");?>
<?php include "functions/functions.php";?>
  <div id="wrapper">

<?php include "sidebar.php"; ?>    
<?php include "config-pdo.php"; ?>
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Insert Youtube Data</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-atom"></i>
            <span class="text-danger"><strong>Important Note for Inserting Data</strong></span></div>
          <div class="card-body">
            <div class="userform">
                <form name="importinventory" id="importinventory" method="post" action="addinventory.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="form-row">

                      <div class="col-md-12">
                        <ul>
                            <li>Fields mark with <strong><span class="text-danger">**</span></strong> are mandatory, fields mark with <strong><span class="text-danger">##</span></strong> has to be numeric</li>
                            <li><strong class="text-danger">Profile URL has to be UNIQUE</strong></li>
                            <li><strong class="text-danger">Profile URL has to be in below FORMAT: https://www.youtube.com/channel/UCRGl2gA9X6BXqOvNL2jePtw</strong></li>
                            <li><strong class="text-danger">Profile URL ID has to be 24 character i.e UCRGl2gA9X6BXqOvNL2jePtw</strong></li>
                        </ul> 
                                              
                      </div>
                    </div>
                  </div>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>   
            
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Insert Youtube Data </div>
          <div class="card-body">
            <div class="userform">
                <form name="addyoutube" id="addyoutube" method="post" action="addyoutube.php">
                  <div class="form-group">
                    <div class="form-row">
                     
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Channel Name <strong class="text-danger">**</strong></label>
                          <input type="text" id="channel_name" name="channel_name" class="form-control" placeholder="Enter Channel Name" required>
                          
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Profile URL <strong class="text-danger">**</strong></label>
                          <input type="url" id="profile_url" name="profile_url" class="form-control" placeholder="https://www.youtube.com/channel/UCRGl2gA9X6BXqOvNL2jePtw" required>
                          <span class="urlerror" style="display:none"><strong class="text-danger">Please Enter Unique Profile URL with proper format</strong></span>    
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Subscribers <strong class="text-danger">##</strong></label>
                          <input type="number" id="subscribers" name="subscribers" class="form-control" placeholder="Enter Subscribers">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Genre</label>
                          <input type="text" id="genre" name="genre" class="form-control" placeholder="Enter Genre">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Language <strong class="text-danger">**</strong></label>
                          <select name="language" id="language" class="form-control select2" required>
                              <option value="">Select Language</option>
                              <option value="English">English</option>
                              <option value="Hindi">Hindi</option>        
                              <option value="Marathi">Marathi</option>
                              <option value="Urdu">Urdu</option>
                              <option value="Bengali">Bengali</option>
                              <option value="Punjabi">Punjabi</option>
                              <option value="Telugu">Telugu</option>
                              <option value="Tamil">Tamil</option>
                              <option value="Gujarati">Gujarati</option>
                              <option value="Kannada">Kannada</option> 
                              <option value="Odia">Odia</option>
                              <option value="Malayalam">Malayalam</option>
                              <option value="Assamese">Assamese</option>
                              <option value="Santali">Santali</option>
                              <option value="Sanskrit">Sanskrit</option>
                              <option value="Maithili">Maithili</option> 
                              <option value="Bodo">Bodo</option>
                              <option value="Dogri">Dogri</option>
                              <option value="Kashmiri">Kashmiri</option>
                              <option value="Konkani">Konkani</option>
                              <option value="Manipuri">Manipuri</option>
                              <option value="Nepali">Nepali</option>
                              <option value="Sindhi">Sindhi</option>      
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Gender <strong class="text-danger">**</strong></label>
                          <select name="gender" id="gender" class="form-control" required>
                              <option value="">Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>        
                              <option value="Both">Both</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">ENLYFT Exclusive <strong class="text-danger">**</strong></label>
                          <select name="enlyft_exclusive" id="enlyft_exclusive" class="form-control" required>
                              <option value="">Select ENLYFT Exclusive</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Integrated Video Cost</label>
                          <input type="text" id="integrated_video_cost"  name="integrated_video_cost" class="form-control" placeholder="Enter Integrated Video Cost">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Dedicated Video Cost</label>
                          <input type="text" id="dedicated_video_cost" name="dedicated_video_cost" class="form-control" placeholder="Enter Dedicated Video Cost">
                        </div>
                      </div>
                       
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Youtube Story Cost</label>
                          <input type="text" id="youtube_story_cost" name="youtube_story_cost" class="form-control" placeholder="Enter Youtube Story Cost">
                        </div>
                      </div>
                       
                       
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Youtube Shorts Cost</label>
                          <input type="text" id="youtube_shorts_cost" name="youtube_shorts_cost" class="form-control" placeholder="Enter Youtube Shorts Cost">
                        </div>
                      </div>                   
        
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Contact Number <strong class="text-danger">** ##</strong></label>
                          <input type="text" id="contact_number" name="contact_number" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Enter Valid 10 Digit Contact Number" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Contact Person Name <strong class="text-danger">**</strong></label>
                          <input type="text" id="contact_person_name" name="contact_person_name" class="form-control" placeholder="Enter Contact Person Name" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Email ID <strong class="text-danger">**</strong></label>
                          <input type="text" id="email_id" name="email_id" class="form-control" placeholder="Enter Email ID" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Comment</label>
                          <input type="text" id="comment" name="comment" class="form-control" placeholder="Enter Comment">
                        </div>
                      </div>
                      
                                            
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="title">Address</label>
                          <textarea name="address" class="form-control" id="address" placeholder="Enter Address" cols="30" rows="2"></textarea>
<!--                          <input type="text" id="address" name="address" class="form-control" placeholder="Enter Male Population (123)" required>-->
                        </div>
                      </div>
                      
                                          
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">City</label>
<!--                          <input type="text" name="city" id="city" class="form-control" placeholder="Enter City">-->
                          <select name="city" id="city" class="form-control select2">
                              <option value="">Select City</option>
                              <option value="Adilabad">Adilabad</option> 
                              <option value="Agra">Agra</option> 
                              <option value="Ahmedabad">Ahmedabad</option> 
                              <option value="Ahmednagar">Ahmednagar</option> 
                              <option value="Aizawl">Aizawl</option> 
                              <option value="Ajitgarh (Mohali) ">Ajitgarh (Mohali)</option> 
                              <option value="Ajmer">Ajmer</option> 
                              <option value="Akola">Akola</option> 
                              <option value="Alappuzha">Alappuzha</option> 
                              <option value="Aligarh">Aligarh</option> 
                              <option value="Alirajpur">Alirajpur</option> 
                              <option value="Allahabad">Allahabad</option> 
                              <option value="Almora">Almora</option> 
                              <option value="Alwar">Alwar</option> 
                              <option value="Ambala">Ambala</option> 
                              <option value="Ambedkar Nagar">Ambedkar Nagar</option> 
                              <option value="Amravati">Amravati</option> 
                              <option value="Amreli district">Amreli district</option> 
                              <option value="Amritsar">Amritsar</option> 
                              <option value="Anand">Anand</option> 
                              <option value="Anantapur">Anantapur</option> 
                              <option value="Anantnag">Anantnag</option> 
                              <option value="Angul">Angul</option> 
                              <option value="Anjaw">Anjaw</option> 
                              <option value="Anuppur">Anuppur</option> 
                              <option value="Araria">Araria</option> 
                              <option value="Ariyalur">Ariyalur</option> 
                              <option value="Arwal">Arwal</option> 
                              <option value="Ashok Nagar">Ashok Nagar</option> 
                              <option value="Auraiya">Auraiya</option> 
                              <option value="Aurangabad">Aurangabad</option> 
                              <option value="Aurangabad">Aurangabad</option> 
                              <option value="Azamgarh">Azamgarh</option> 
                              <option value="Badgam">Badgam</option> 
                              <option value="Bagalkot">Bagalkot</option> 
                              <option value="Bageshwar">Bageshwar</option> 
                              <option value="Bagpat">Bagpat</option> 
                              <option value="Bahraich">Bahraich</option> 
                              <option value="Baksa">Baksa</option> 
                              <option value="Balaghat">Balaghat</option> 
                              <option value="Balangir">Balangir</option>                               
                              <option value="Balasore">Balasore</option> 
                              <option value="Ballia">Ballia</option> 
                              <option value="Balrampur">Balrampur</option> 
                              <option value="Banaskantha">Banaskantha</option> 
                              <option value="Banda">Banda</option> 
                              <option value="Bandipora">Bandipora</option> 
                              <option value="Bangalore">Bangalore</option>                               
                              <option value="Banka">Banka</option> 
                              <option value="Bankura">Bankura</option>                               
                              <option value="Banswara">Banswara</option> 
                              <option value="Barabanki">Barabanki</option> 
                              <option value="Baramulla">Baramulla</option> 
                              <option value="Baran">Baran</option> 
                              <option value="Bardhaman">Bardhaman</option> 
                              <option value="Bareilly">Bareilly</option> 
                              <option value="Bargarh (Baragarh)">Bargarh (Baragarh)</option> 
                              <option value="Barmer">Barmer</option> 
                              <option value="Barnala">Barnala</option> 
                              <option value="Barpeta">Barpeta</option> 
                              <option value="Barwani">Barwani</option> 
                              <option value="Bastar">Bastar</option> 
                              <option value="Basti">Basti</option> 
                              <option value="Bathinda">Bathinda</option> 
                              <option value="Beed">Beed</option> 
                              <option value="Begusarai">Begusarai</option> 
                              <option value="Belgaum">Belgaum</option> 
                              <option value="Bellary">Bellary</option> 
                              <option value="Betul">Betul</option> 
                              <option value="Bhadrak">Bhadrak</option> 
                              <option value="Bhagalpur">Bhagalpur</option> 
                              <option value="Bhandara">Bhandara</option> 
                              <option value="Bharatpur">Bharatpur</option> 
                              <option value="Bharuch">Bharuch</option> 
                              <option value="Bhavnagar">Bhavnagar</option> 
                              <option value="Bhilwara">Bhilwara</option> 
                              <option value="Bhind">Bhind</option> 
                              <option value="Bhiwani">Bhiwani</option> 
                              <option value="Bhojpur">Bhojpur</option> 
                              <option value="Bhopal">Bhopal</option> 
                              <option value="Bidar">Bidar</option> 
                              <option value="Bijapur">Bijapur</option> 
                              <option value="Bijapur">Bijapur</option> 
                              <option value="Bijnor">Bijnor</option>                               
                              <option value="Bikaner">Bikaner</option> 
                              <option value="Bilaspur">Bilaspur</option> 
                              <option value="Bilaspur">Bilaspur</option> 
                              <option value="Birbhum">Birbhum</option> 
                              <option value="Bishnupur">Bishnupur</option> 
                              <option value="Bokaro">Bokaro</option>                               
                              <option value="Bongaigaon">Bongaigaon</option> 
                              <option value="Boudh (Bauda)">Boudh (Bauda)</option> 
                              <option value="Budaun">Budaun</option> 
                              <option value="Bulandshahr">Bulandshahr</option> 
                              <option value="Buldhana">Buldhana</option> 
                              <option value="Bundi">Bundi</option> 
                              <option value="Burhanpur">Burhanpur</option> 
                              <option value="Buxar">Buxar</option> 
                              <option value="Cachar">Cachar</option> 
                              <option value="Central Delhi">Central Delhi</option> 
                              <option value="Chamarajnagar">Chamarajnagar</option> 
                              <option value="Chamba">Chamba</option> 
                              <option value="Chamoli">Chamoli</option> 
                              <option value="Champawat">Champawat</option> 
                              <option value="Champhai">Champhai</option> 
                              <option value="Chandauli">Chandauli</option> 
                              <option value="Chandel">Chandel</option> 
                              <option value="Chandigarh">Chandigarh</option> 
                              <option value="Chandrapur">Chandrapur</option>
                               <option value="Changlang">Changlang</option> 
                               <option value="Chatra">Chatra</option> 
                               <option value="Chennai">Chennai</option> 
                               <option value="Chhatarpur">Chhatarpur</option> 
                               <option value="Chhatrapati Shahuji Maharaj Nagar"> Chhatrapati Shahuji Maharaj Nagar </option> 
                               <option value="Chhindwara">Chhindwara</option> 
                               <option value="Chikkaballapur">Chikkaballapur</option> 
                               <option value="Chikkamagaluru">Chikkamagaluru</option> 
                               <option value="Chirang">Chirang</option> 
                               <option value="Chitradurga">Chitradurga</option> 
                               <option value="Chitrakoot">Chitrakoot</option> 
                               <option value="Chittoor">Chittoor</option> 
                               <option value="Chittorgarh">Chittorgarh</option> 
                               <option value="Churachandpur">Churachandpur</option> 
                               <option value="Churu">Churu</option> 
                               <option value="Coimbatore">Coimbatore</option> 
                               <option value="CoochBehar">Cooch Behar</option> 
                               <option value="Cuddalore">Cuddalore</option> 
                               <option value="Cuttack">Cuttack</option> 
                               <option value="Dadra and Nagar Haveli"> Dadra and Nagar Haveli </option> 
                               <option value="Dahod">Dahod</option> 
                               <option value="Dakshin Dinajpur">Dakshin Dinajpur</option> 
                               <option value="Dakshina Kannada">Dakshina Kannada</option> 
                               <option value="Daman">Daman</option> 
                               <option value="Damoh">Damoh</option> 
                               <option value="Dantewada">Dantewada</option> 
                               <option value="Darbhanga">Darbhanga</option> 
                               <option value="Darjeeling">Darjeeling</option> 
                               <option value="Darrang">Darrang</option> 
                               <option value="Datia">Datia</option> 
                               <option value="Dausa">Dausa</option> 
                               <option value="Davanagere">Davanagere</option> 
                               <option value="Debagarh (Deogarh)">Debagarh (Deogarh)</option> 
                               <option value="Dehradun">Dehradun</option> 
                               <option value="Deoghar">Deoghar</option> 
                               <option value="Deoria">Deoria</option> 
                               <option value="Dewas">Dewas</option> 
                               <option value="Dhalai">Dhalai</option> 
                               <option value="Dhamtari">Dhamtari</option> 
                               <option value="Dhanbad">Dhanbad</option> 
                               <option value="Dhar">Dhar</option> 
                               <option value="Dharmapuri">Dharmapuri</option> 
                               <option value="Dharwad">Dharwad</option> 
                               <option value="Dhemaji">Dhemaji</option> 
                               <option value="Dhenkanal">Dhenkanal</option> 
                               <option value="Dholpur">Dholpur</option> 
                               <option value="Dhubri">Dhubri</option> 
                               <option value="Dhule">Dhule</option> 
                               <option value="Dibang Valley">Dibang Valley</option> 
                               <option value="Dibrugarh">Dibrugarh</option> 
                               <option value="Dima Hasao">Dima Hasao</option> 
                               <option value="Dimapur">Dimapur</option> 
                               <option value="Dindigul">Dindigul</option> 
                               <option value="Dindori">Dindori</option> 
                               <option value="Diu">Diu</option> 
                               <option value="Doda">Doda</option> 
                               <option value="Dumka">Dumka</option> 
                               <option value="Dungapur">Dungapur</option> 
                               <option value="Durg">Durg</option> 
                               <option value="East Champaran">East Champaran</option> 
                               <option value="East Delhi">East Delhi</option> 
                               <option value="East Garo Hills">East Garo Hills</option> 
                               <option value="East Khasi Hills">East Khasi Hills</option> 
                               <option value="East Siang">East Siang</option> 
                               <option value="East Sikkim">East Sikkim</option> 
                               <option value="East Singhbhum">East Singhbhum</option> 
                               <option value="Eluru">Eluru</option> 
                               <option value="Ernakulam">Ernakulam</option> 
                               <option value="Erode">Erode</option> 
                               <option value="Etah">Etah</option> 
                               <option value="Etawah">Etawah</option> 
                               <option value="Faizabad">Faizabad</option> 
                               <option value="Faridabad">Faridabad</option> 
                               <option value="Faridkot">Faridkot</option> 
                               <option value="Farrukhabad">Farrukhabad</option> 
                               <option value="Fatehabad">Fatehabad</option> 
                               <option value="Fatehgarh Sahib">Fatehgarh Sahib</option> 
                               <option value="Fatehpur">Fatehpur</option> 
                               <option value="Fazilka">Fazilka</option> 
                               <option value="Firozabad">Firozabad</option> 
                               <option value="Firozpur">Firozpur</option> 
                               <option value="Gadag">Gadag</option> 
                               <option value="Gadchiroli">Gadchiroli</option> 
                               <option value="Gajapati">Gajapati</option> 
                               <option value="Ganderbal">Ganderbal</option> 
                               <option value="Gandhinagar">Gandhinagar</option> 
                               <option value="Ganganagar">Ganganagar</option> 
                               <option value="Ganjam">Ganjam</option> 
                               <option value="Garhwa">Garhwa</option> 
                               <option value="Gautam Buddh Nagar">Gautam Buddh Nagar</option> 
                               <option value="Gaya">Gaya</option> 
                               <option value="Ghaziabad">Ghaziabad</option> 
                               <option value="Ghazipur">Ghazipur</option> 
                               <option value="Giridih">Giridih</option> 
                               <option value="Goalpara">Goalpara</option> 
                               <option value="Godda">Godda</option> 
                               <option value="Golaghat">Golaghat</option> 
                               <option value="Gonda">Gonda</option> 
                               <option value="Gondia">Gondia</option> 
                               <option value="Gopalganj">Gopalganj</option> 
                               <option value="Gorakhpur">Gorakhpur</option> 
                               <option value="Gulbarga">Gulbarga</option> 
                               <option value="Gumla">Gumla</option> 
                               <option value="Guna">Guna</option> 
                               <option value="Guntur">Guntur</option> 
                               <option value="Gurdaspur">Gurdaspur</option> 
                               <option value="Gurgaon">Gurgaon</option> 
                               <option value="Gwalior">Gwalior</option> 
                               <option value="Hailakandi">Hailakandi</option> 
                               <option value="Hamirpur">Hamirpur</option> 
                               <option value="Hamirpur">Hamirpur</option> 
                               <option value="Hanumangarh">Hanumangarh</option> 
                               <option value="Harda">Harda</option> 
                               <option value="Hardoi">Hardoi</option> 
                               <option value="Haridwar">Haridwar</option> 
                               <option value="Hassan">Hassan</option> 
                               <option value="Haveri district">Haveri district</option> 
                               <option value="Hazaribag">Hazaribag</option> 
                               <option value="Hingoli">Hingoli</option> 
                               <option value="Hissar">Hissar</option> 
                               <option value="Hooghly">Hooghly</option> 
                               <option value="Hoshangabad">Hoshangabad</option> 
                               <option value="Hoshiarpur">Hoshiarpur</option> 
                               <option value="Howrah">Howrah</option> 
                               <option value="Hyderabad">Hyderabad</option> 
                               <option value="Hyderabad">Hyderabad</option> 
                               <option value="Idukki">Idukki</option> 
                               <option value="Imphal East">Imphal East</option> 
                               <option value="Imphal West">Imphal West</option> 
                               <option value="Indore">Indore</option> 
                               <option value="Jabalpur">Jabalpur</option> 
                               <option value="Jagatsinghpur">Jagatsinghpur</option> 
                               <option value="Jaintia Hills">Jaintia Hills</option> 
                               <option value="Jaipur">Jaipur</option> 
                               <option value="Jaisalmer">Jaisalmer</option> 
                               <option value="Jajpur">Jajpur</option> 
                               <option value="Jalandhar">Jalandhar</option> 
                               <option value="Jalaun">Jalaun</option> 
                               <option value="Jalgaon">Jalgaon</option> 
                               <option value="Jalna">Jalna</option> 
                               <option value="Jalore">Jalore</option> 
                               <option value="Jalpaiguri">Jalpaiguri</option> 
                               <option value="Jammu">Jammu</option> 
                               <option value="Jamnagar">Jamnagar</option> 
                               <option value="Jamtara">Jamtara</option> 
                               <option value="Jamui">Jamui</option> 
                               <option value="Janjgir-Champa">Janjgir-Champa</option> 
                               <option value="Jashpur">Jashpur</option> 
                               <option value="Jaunpur district">Jaunpur district</option> 
                               <option value="Jehanabad">Jehanabad</option> 
                               <option value="Jhabua">Jhabua</option> 
                               <option value="Jhajjar">Jhajjar</option> 
                               <option value="Jhalawar">Jhalawar</option> 
                               <option value="Jhansi">Jhansi</option> 
                               <option value="Jharsuguda">Jharsuguda</option> 
                               <option value="Jhunjhunu">Jhunjhunu</option> 
                               <option value="Jind">Jind</option> 
                               <option value="Jodhpur">Jodhpur</option> 
                               <option value="Jorhat">Jorhat</option> 
                               <option value="Junagadh">Junagadh</option> 
                               <option value="Jyotiba Phule Nagar">Jyotiba Phule Nagar</option> 
                               <option value="Kabirdham (formerly Kawardha)"> Kabirdham (formerly Kawardha) </option> 
                               <option value="Kadapa">Kadapa</option> 
                               <option value="Kaimur">Kaimur</option> 
                               <option value="Kaithal">Kaithal</option> 
                               <option value="Kakinada">Kakinada</option> 
                               <option value="Kalahandi">Kalahandi</option> 
                               <option value="Kamrup">Kamrup</option> 
                               <option value="Kamrup Metropolitan">Kamrup Metropolitan</option> 
                               <option value="Kanchipuram">Kanchipuram</option> 
                               <option value="Kandhamal">Kandhamal</option> 
                               <option value="Kangra">Kangra</option> 
                               <option value="Kanker">Kanker</option> 
                               <option value="Kannauj">Kannauj</option> 
                               <option value="Kannur">Kannur</option> 
                               <option value="Kanpur">Kanpur</option> 
                               <option value="Kanshi Ram Nagar">Kanshi Ram Nagar</option> 
                               <option value="Kanyakumari">Kanyakumari</option> 
                               <option value="Kapurthala">Kapurthala</option> 
                               <option value="Karaikal">Karaikal</option> 
                               <option value="Karauli">Karauli</option> 
                               <option value="Karbi Anglong">Karbi Anglong</option> 
                               <option value="Kargil">Kargil</option> 
                               <option value="Karimganj">Karimganj</option> 
                               <option value="Karimnagar">Karimnagar</option> 
                               <option value="Karnal">Karnal</option> 
                               <option value="Karur">Karur</option> 
                               <option value="Kasaragod">Kasaragod</option> 
                               <option value="Kathua">Kathua</option> 
                               <option value="Katihar">Katihar</option> 
                               <option value="Katni">Katni</option> 
                               <option value="Kaushambi">Kaushambi</option> 
                               <option value="Kendrapara">Kendrapara</option> 
                               <option value="Kendujhar (Keonjhar)"> Kendujhar (Keonjhar) </option> 
                               <option value="Khagaria">Khagaria</option> 
                               <option value="Khammam">Khammam</option> 
                               <option value="Khandwa (EastNimar)">Khandwa (East Nimar)</option> 
                               <option value="Khargone (WestNimar)"> Khargone (West Nimar) </option> 
                               <option value="Kheda">Kheda</option> 
                               <option value="Khordha">Khordha</option> 
                               <option value="Khowai">Khowai</option> 
                               <option value="Khunti">Khunti</option> 
                               <option value="Kinnaur">Kinnaur</option> 
                               <option value="Kishanganj">Kishanganj</option> 
                               <option value="Kishtwar">Kishtwar</option> 
                               <option value="Kodagu">Kodagu</option> 
                               <option value="Koderma">Koderma</option> 
                               <option value="Kohima">Kohima</option> 
                               <option value="Kokrajhar">Kokrajhar</option> 
                               <option value="Kolar">Kolar</option> 
                               <option value="Kolasib">Kolasib</option> 
                               <option value="Kolhapur">Kolhapur</option> 
                               <option value="Kolkata">Kolkata</option> 
                               <option value="Kollam">Kollam</option> 
                               <option value="Koppal">Koppal</option> 
                               <option value="Koraput">Koraput</option> 
                               <option value="Korba">Korba</option> 
                               <option value="Koriya">Koriya</option> 
                               <option value="Kota">Kota</option> 
                               <option value="Kottayam">Kottayam</option> 
                               <option value="Kozhikode">Kozhikode</option> 
                               <option value="Krishna">Krishna</option> 
                               <option value="Kulgam">Kulgam</option> 
                               <option value="Kullu">Kullu</option> 
                               <option value="Kupwara">Kupwara</option> 
                               <option value="Kurnool">Kurnool</option> 
                               <option value="Kurukshetra">Kurukshetra</option> 
                               <option value="KurungKumey">Kurung Kumey</option> 
                               <option value="Kushinagar">Kushinagar</option> 
                               <option value="Kutch">Kutch</option> 
                               <option value="Lahaul and Spiti">Lahaul and Spiti</option> 
                               <option value="Lakhimpur">Lakhimpur</option> 
                               <option value="Lakhimpur Kheri">Lakhimpur Kheri</option> 
                               <option value="Lakhisarai">Lakhisarai</option> 
                               <option value="Lalitpur">Lalitpur</option> 
                               <option value="Latehar">Latehar</option> 
                               <option value="Latur">Latur</option> 
                               <option value="Lawngtlai">Lawngtlai</option> 
                               <option value="Leh">Leh</option> 
                               <option value="Lohardaga">Lohardaga</option> 
                               <option value="Lohit">Lohit</option> 
                               <option value="Lower Dibang Valley">Lower Dibang Valley</option> 
                               <option value="Lower Subansiri">Lower Subansiri</option> 
                               <option value="Lucknow">Lucknow</option> 
                               <option value="Ludhiana">Ludhiana</option> 
                               <option value="Lunglei">Lunglei</option> 
                               <option value="Madhepura">Madhepura</option> 
                               <option value="Madhubani">Madhubani</option> 
                               <option value="Madurai">Madurai</option> 
                               <option value="Mahamaya Nagar">Mahamaya Nagar</option> 
                               <option value="Maharajganj">Maharajganj</option> 
                               <option value="Mahasamund">Mahasamund</option> 
                               <option value="Mahbubnagar">Mahbubnagar</option>                                
                               <option value="Mahe">Mahe</option> 
                               <option value="Mahendragarh">Mahendragarh</option> 
                               <option value="Mahoba">Mahoba</option> 
                               <option value="Mainpuri">Mainpuri</option> 
                               <option value="Malappuram">Malappuram</option> 
                               <option value="Maldah">Maldah</option> 
                               <option value="Malkangiri">Malkangiri</option> 
                               <option value="Mamit">Mamit</option> 
                               <option value="Mandi">Mandi</option> 
                               <option value="Mandla">Mandla</option> 
                               <option value="Mandsaur">Mandsaur</option> 
                               <option value="Mandya">Mandya</option> 
                               <option value="Mansa">Mansa</option> 
                               <option value="Marigaon">Marigaon</option> 
                               <option value="Mathura">Mathura</option> 
                               <option value="Mau">Mau</option> 
                               <option value="Mayurbhanj">Mayurbhanj</option> 
                               <option value="Medak">Medak</option> 
                               <option value="Meerut">Meerut</option> 
                               <option value="Mehsana">Mehsana</option> 
                               <option value="Mewat">Mewat</option> 
                               <option value="Mirzapur">Mirzapur</option> 
                               <option value="Moga">Moga</option> 
                               <option value="Mokokchung">Mokokchung</option> 
                               <option value="Mon">Mon</option> 
                               <option value="Moradabad">Moradabad</option>                                
                               <option value="Morena">Morena</option> 
                               <option value="Mumbai">Mumbai</option>                                
                               <option value="Munger">Munger</option> 
                               <option value="Murshidabad">Murshidabad</option> 
                               <option value="Muzaffarnagar">Muzaffarnagar</option> 
                               <option value="Muzaffarpur">Muzaffarpur</option> 
                               <option value="Mysore">Mysore</option> 
                               <option value="Nabarangpur">Nabarangpur</option> 
                               <option value="Nadia">Nadia</option> 
                               <option value="Nagaon">Nagaon</option> 
                               <option value="Nagapattinam">Nagapattinam</option> 
                               <option value="Nagaur">Nagaur</option> 
                               <option value="Nagpur">Nagpur</option> 
                               <option value="Nainital">Nainital</option> 
                               <option value="Nalanda">Nalanda</option> 
                               <option value="Nalbari">Nalbari</option> 
                               <option value="Nalgonda">Nalgonda</option> 
                               <option value="Namakkal">Namakkal</option> 
                               <option value="Nanded">Nanded</option> 
                               <option value="Nandurbar">Nandurbar</option> 
                               <option value="Narayanpur">Narayanpur</option> 
                               <option value="Narmada">Narmada</option> 
                               <option value="Narsinghpur">Narsinghpur</option> 
                               <option value="Nashik">Nashik</option> 
                               <option value="Navsari">Navsari</option> 
                               <option value="Navi Mumbai">Navi Mumbai</option> 
                               <option value="Nawada">Nawada</option> 
                               <option value="Nawanshahr">Nawanshahr</option> 
                               <option value="Nayagarh">Nayagarh</option> 
                               <option value="Neemuch">Neemuch</option> 
                               <option value="Nellore">Nellore</option> 
                               <option value="NewDelhi">New Delhi</option> 
                               <option value="Nilgiris">Nilgiris</option> 
                               <option value="Nizamabad">Nizamabad</option> 
                               <option value="North 24 Parganas">North 24 Parganas</option> 
                               <option value="North Delhi">North Delhi</option> 
                               <option value="North East Delhi">North East Delhi</option> 
                               <option value="North Goa">North Goa</option> 
                               <option value="North Sikkim">North Sikkim</option> 
                               <option value="North Tripura">North Tripura</option> 
                               <option value="North West Delhi">North West Delhi</option> 
                               <option value="Nuapada">Nuapada</option> 
                               <option value="Ongole">Ongole</option> 
                               <option value="Osmanabad">Osmanabad</option> 
                               <option value="Pakur">Pakur</option> 
                               <option value="Palakkad">Palakkad</option> 
                               <option value="Palamu">Palamu</option> 
                               <option value="Pali">Pali</option> 
                               <option value="Palwal">Palwal</option> 
                               <option value="Panchkula">Panchkula</option> 
                               <option value="Panchmahal">Panchmahal</option> 
                               <option value="Panchsheel Nagar district (Hapur)"> Panchsheel Nagar district (Hapur) </option> 
                               <option value="Panipat">Panipat</option> 
                               <option value="Panna">Panna</option> 
                               <option value="PapumPare">Papum Pare</option> 
                               <option value="Parbhani">Parbhani</option> 
                               <option value="Paschim Medinipur">Paschim Medinipur</option> 
                               <option value="Patan">Patan</option> 
                               <option value="Pathanamthitta">Pathanamthitta</option> 
                               <option value="Pathankot">Pathankot</option> 
                               <option value="Patiala">Patiala</option> 
                               <option value="Patna">Patna</option> 
                               <option value="Pauri Garhwal">Pauri Garhwal</option> 
                               <option value="Perambalur">Perambalur</option> 
                               <option value="Phek">Phek</option> 
                               <option value="Pilibhit">Pilibhit</option> 
                               <option value="Pithoragarh">Pithoragarh</option> 
                               <option value="Pondicherry">Pondicherry</option> 
                               <option value="Poonch">Poonch</option> 
                               <option value="Porbandar">Porbandar</option> 
                               <option value="Pratapgarh">Pratapgarh</option> 
                               <option value="Pratapgarh">Pratapgarh</option> 
                               <option value="Pudukkottai">Pudukkottai</option> 
                               <option value="Pulwama">Pulwama</option> 
                               <option value="Pune">Pune</option> 
                               <option value="Purba Medinipur">Purba Medinipur</option> 
                               <option value="Puri">Puri</option> 
                               <option value="Purnia">Purnia</option> 
                               <option value="Purulia">Purulia</option> 
                               <option value="Raebareli">Raebareli</option> 
                               <option value="Raichur">Raichur</option> 
                               <option value="Raigad">Raigad</option> 
                               <option value="Raigarh">Raigarh</option> 
                               <option value="Raipur">Raipur</option> 
                               <option value="Raisen">Raisen</option> 
                               <option value="Rajauri">Rajauri</option> 
                               <option value="Rajgarh">Rajgarh</option> 
                               <option value="Rajkot">Rajkot</option> 
                               <option value="Rajnandgaon">Rajnandgaon</option> 
                               <option value="Rajsamand">Rajsamand</option> 
                               <option value="Ramabai Nagar (Kanpur Dehat)"> Ramabai Nagar (Kanpur Dehat) </option> 
                               <option value="Ramanagara">Ramanagara</option> 
                               <option value="Ramanathapuram">Ramanathapuram</option> 
                               <option value="Ramban">Ramban</option> 
                               <option value="Ramgarh">Ramgarh</option> 
                               <option value="Rampur">Rampur</option> 
                               <option value="Ranchi">Ranchi</option> 
                               <option value="Ratlam">Ratlam</option> 
                               <option value="Ratnagiri">Ratnagiri</option> 
                               <option value="Rayagada">Rayagada</option> 
                               <option value="Reasi">Reasi</option> 
                               <option value="Rewa">Rewa</option> 
                               <option value="Rewari">Rewari</option> 
                               <option value="RiBhoi">Ri Bhoi</option> 
                               <option value="Rohtak">Rohtak</option> 
                               <option value="Rohtas">Rohtas</option> 
                               <option value="Rudraprayag">Rudraprayag</option> 
                               <option value="Rupnagar">Rupnagar</option> 
                               <option value="Sabarkantha">Sabarkantha</option> 
                               <option value="Sagar">Sagar</option> 
                               <option value="Saharanpur">Saharanpur</option> 
                               <option value="Saharsa">Saharsa</option> 
                               <option value="Sahibganj">Sahibganj</option> 
                               <option value="Saiha">Saiha</option> 
                               <option value="Salem">Salem</option> 
                               <option value="Samastipur">Samastipur</option> 
                               <option value="Samba">Samba</option> 
                               <option value="Sambalpur">Sambalpur</option> 
                               <option value="Sangli">Sangli</option> 
                               <option value="Sangrur">Sangrur</option> 
                               <option value="Sant Kabir Nagar">Sant Kabir Nagar</option> 
                               <option value="Sant Ravidas Nagar">Sant Ravidas Nagar</option> 
                               <option value="Saran">Saran</option> 
                               <option value="Satara">Satara</option> 
                               <option value="Satna">Satna</option> 
                               <option value="Sawai Madhopur">Sawai Madhopur</option> 
                               <option value="Sehore">Sehore</option> 
                               <option value="Senapati">Senapati</option> 
                               <option value="Seoni">Seoni</option> 
                               <option value="Seraikela Kharsawan">Seraikela Kharsawan</option> 
                               <option value="Serchhip">Serchhip</option> 
                               <option value="Shahdol">Shahdol</option> 
                               <option value="Shahjahanpur">Shahjahanpur</option> 
                               <option value="Shajapur">Shajapur</option> 
                               <option value="Shamli">Shamli</option> 
                               <option value="Sheikhpura">Sheikhpura</option> 
                               <option value="Sheohar">Sheohar</option> 
                               <option value="Sheopur">Sheopur</option> 
                               <option value="Shimla">Shimla</option> 
                               <option value="Shimoga">Shimoga</option> 
                               <option value="Shivpuri">Shivpuri</option> 
                               <option value="Shopian">Shopian</option> 
                               <option value="Shravasti">Shravasti</option> 
                               <option value="Sibsagar">Sibsagar</option> 
                               <option value="Siddharthnagar">Siddharthnagar</option> 
                               <option value="Sidhi">Sidhi</option> 
                               <option value="Sikar">Sikar</option> 
                               <option value="Simdega">Simdega</option> 
                               <option value="Sindhudurg">Sindhudurg</option> 
                               <option value="Singrauli">Singrauli</option> 
                               <option value="Sirmaur">Sirmaur</option> 
                               <option value="Sirohi">Sirohi</option> 
                               <option value="Sirsa">Sirsa</option> 
                               <option value="Sitamarhi">Sitamarhi</option> 
                               <option value="Sitapur">Sitapur</option> 
                               <option value="Sivaganga">Sivaganga</option> 
                               <option value="Siwan">Siwan</option> 
                               <option value="Solan">Solan</option> 
                               <option value="Solapur">Solapur</option> 
                               <option value="Sonbhadra">Sonbhadra</option> 
                               <option value="Sonipat">Sonipat</option> 
                               <option value="Sonitpur">Sonitpur</option> 
                               <option value="South 24 Parganas">South 24 Parganas</option> 
                               <option value="South Delhi">South Delhi</option> 
                               <option value="South Garo Hills">South Garo Hills</option> 
                               <option value="South Goa">South Goa</option> 
                               <option value="South Sikkim">South Sikkim</option> 
                               <option value="South Tripura">South Tripura</option> 
                               <option value="South West Delhi">South West Delhi</option> 
                               <option value="Sri Muktsar Sahib">Sri Muktsar Sahib</option> 
                               <option value="Srikakulam">Srikakulam</option> 
                               <option value="Srinagar">Srinagar</option> 
                               <option value="Subarnapur (Sonepur)"> Subarnapur (Sonepur) </option> 
                               <option value="Sultanpur">Sultanpur</option> 
                               <option value="Sundergarh">Sundergarh</option> 
                               <option value="Supaul">Supaul</option> 
                               <option value="Surat">Surat</option> 
                               <option value="Surendranagar">Surendranagar</option> 
                               <option value="Surguja">Surguja</option> 
                               <option value="Tamenglong">Tamenglong</option> 
                               <option value="TarnTaran">Tarn Taran</option> 
                               <option value="Tawang">Tawang</option> 
                               <option value="Tehri Garhwal">Tehri Garhwal</option> 
                               <option value="Thane">Thane</option> 
                               <option value="Thanjavur">Thanjavur</option> 
                               <option value="The Dangs">The Dangs</option> 
                               <option value="Theni">Theni</option> 
                               <option value="Thiruvananthapuram">Thiruvananthapuram</option> 
                               <option value="Thoothukudi">Thoothukudi</option> 
                               <option value="Thoubal">Thoubal</option> 
                               <option value="Thrissur">Thrissur</option> 
                               <option value="Tikamgarh">Tikamgarh</option> 
                               <option value="Tinsukia">Tinsukia</option> 
                               <option value="Tirap">Tirap</option> 
                               <option value="Tiruchirappalli">Tiruchirappalli</option> 
                               <option value="Tirunelveli">Tirunelveli</option> 
                               <option value="Tirupur">Tirupur</option> 
                               <option value="Tiruvallur">Tiruvallur</option> 
                               <option value="Tiruvannamalai">Tiruvannamalai</option> 
                               <option value="Tiruvarur">Tiruvarur</option>
                               <option value="Tonk">Tonk</option>
                               <option value="Tuensang">Tuensang</option>
                               <option value="Tumkur">Tumkur</option>
                               <option value="Udaipur">Udaipur</option>
                               <option value="Udalguri">Udalguri</option>
                               <option value="Udham Singh Nagar">Udham Singh Nagar</option>
                               <option value="Udhampur">Udhampur</option>
                               <option value="Udupi">Udupi</option>
                               <option value="Ujjain">Ujjain</option>
                               <option value="Ukhrul">Ukhrul</option>
                               <option value="Umaria">Umaria</option>
                               <option value="Una">Una</option>
                               <option value="Unnao">Unnao</option>
                               <option value="Upper Siang">Upper Siang</option>
                               <option value="Upper Subansiri">Upper Subansiri</option>
                               <option value="Uttar Dinajpur">Uttar Dinajpur</option>
                               <option value="Uttara Kannada">Uttara Kannada</option>
                               <option value="Uttarkashi">Uttarkashi</option>
                               <option value="Vadodara">Vadodara</option>
                               <option value="Vaishali">Vaishali</option>
                               <option value="Valsad">Valsad</option>
                               <option value="Varanasi">Varanasi</option>
                               <option value="Vellore">Vellore</option>
                               <option value="Vidisha">Vidisha</option>
                               <option value="Viluppuram">Viluppuram</option>
                               <option value="Virudhunagar">Virudhunagar</option>
                               <option value="Visakhapatnam">Visakhapatnam</option>
                               <option value="Vizianagaram">Vizianagaram</option>
                               <option value="Vyara">Vyara</option>
                               <option value="Warangal">Warangal</option>
                               <option value="Wardha">Wardha</option>
                               <option value="Washim">Washim</option>
                               <option value="Wayanad">Wayanad</option>
                               <option value="West Champaran">West Champaran</option>
                               <option value="West Delhi">West Delhi</option>
                               <option value="West Garo Hills">West Garo Hills</option>
                               <option value="West Kameng">West Kameng</option>
                               <option value="West Khasi Hills">West Khasi Hills</option>
                               <option value="West Siang">West Siang</option>
                               <option value="West Sikkim">West Sikkim</option>
                               <option value="West Singhbhum">West Singhbhum</option>
                               <option value="West Tripura">West Tripura</option>
                               <option value="Wokha">Wokha</option>
                               <option value="Yadgir">Yadgir</option>
                               <option value="Yamuna Nagar">Yamuna Nagar</option>
                               <option value="Yanam">Yanam</option>
                               <option value="Yavatmal">Yavatmal</option>
                               <option value="Zunheboto">Zunheboto</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">State <strong class="text-danger">**</strong></label>
                          <select name="state" id="state" class="form-control select2" required>
                              <option value="">Select State</option>
                              <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                          </select>
<!--                          <input type="number" id="target_audience" name="target_audience" class="form-control" placeholder="Enter Target Audience" required>-->
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Avg. Views <strong class="text-danger">##</strong></label>
                          <input type="number" id="avg_views" name="avg_views" class="form-control" placeholder="Enter Avg. Views">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Avg. Likes <strong class="text-danger">##</strong></label>
                          <input type="number" id="avg_likes" name="avg_likes" class="form-control" placeholder="Enter Avg. Likes">
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Influencer Name <strong class="text-danger">**</strong></label>
                          <input type="text" id="influencer_name" name="influencer_name" class="form-control" placeholder="Enter Influencer Name" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Campaign Done Earlier? <strong class="text-danger">**</strong></label>
                          <select name="campaign_done_earlier" id="campaign_done_earlier" class="form-control" required>
                              <option value="">Campaign Done Earlier?</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">No. of Campaign done <strong class="text-danger">** ##</strong></label>
                          <input type="number" id="no_of_campaign" name="no_of_campaign" class="form-control" placeholder="Enter No. of Campaign" required>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Influencer Category <strong class="text-danger">**</strong></label>
                          <select name="influencer_category" id="influencer_category" class="form-control" required>
                              <option value="">Select Influencer Category</option>
                              <option value="CAT - A">CAT - A</option>
                              <option value="CAT - B">CAT - B</option>        
                              <option value="CAT - C">CAT - C</option>        
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title">Name of Client Worked Before</label>
                          <input type="text" id="name_of_client_worked_before" name="name_of_client_worked_before" class="form-control" placeholder="Enter Name of Client Worked Before">
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  <button class="btn btn-success" onclick="return insert()" type="submit" name="insertyoutube" id="insertyoutube">Submit</button>
                </form>
            </div>
          </div>
          <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>

      </div>
      <!-- /.container-fluid -->

 <?php include "footer.php"; ?>
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script> 
 <script>
     function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;  
        }
     
     function insert(){         
        var channel_name = $('#channel_name').val().trim();
        var profile_url = $('#profile_url').val().trim();
        var extension1 = profile_url.split('/').pop();
//        alert(extension1);
        var subscribers = $('#subscribers').val().trim();
        var genre = $('#genre').val().trim();
        var language = $('#language').val().trim();
        var gender = $('#gender').val().trim();
        var enlyft_exclusive = $('#enlyft_exclusive').val().trim();
        var integrated_video_cost = $('#integrated_video_cost').val().trim();
        var dedicated_video_cost = $('#dedicated_video_cost').val().trim();
        var youtube_story_cost = $('#youtube_story_cost').val().trim();
        var youtube_shorts_cost = $('#youtube_shorts_cost').val().trim();
        var contact_number = $('#contact_number').val().trim();
        var contact_person_name = $('#contact_person_name').val().trim();
        var email_id = $('#email_id').val().trim();
        var comment = $('#comment').val().trim();
        var address = $('#address').val().trim();
        var city = $('#city').val().trim();
        var state = $('#state').val().trim();
        var avg_views = $('#avg_views').val().trim();
        var avg_likes = $('#avg_likes').val().trim();
        var influencer_name = $('#influencer_name').val().trim();
        var campaign_done_earlier = $("#campaign_done_earlier").val().trim();
        var no_of_campaign = $("#no_of_campaign").val().trim();
        var influencer_category = $("#influencer_category").val().trim();
        var name_of_client_worked_before = $("#name_of_client_worked_before").val().trim();
        
        if(channel_name !== ""){
//            alert("hello");
            if(profile_url !== ""){
                if(subscribers !== ""){
                   subscribers = parseInt(subscribers);
                   if(isNaN(subscribers) && typeof subscribers !== 'number'){
                        alert("Please Enter Valid Numeric Data");
                        $("#subscribers").focus();
                    }
                }
                if(language !== ""){
                    if(gender !== ""){
                        if(enlyft_exclusive !== ""){
                            if(integrated_video_cost !== ""){
                               integrated_video_cost = parseFloat(integrated_video_cost);
                               if(isNaN(integrated_video_cost) && typeof integrated_video_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#integrated_video_cost").focus();
                               }
                            }
                            if(dedicated_video_cost !== ""){
                                dedicated_video_cost = parseFloat(dedicated_video_cost);
                                if(isNaN(dedicated_video_cost) && typeof dedicated_video_cost !== 'number'){
                                      alert("Please Enter Valid Numeric Data");
                                      $("#dedicated_video_cost").focus();
                               }
                            }
                            if(youtube_story_cost !== ""){
                                youtube_story_cost = parseFloat(youtube_story_cost);
                                if(isNaN(youtube_story_cost) && typeof youtube_story_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#youtube_story_cost").focus();
                                }
                            }
                            if(youtube_shorts_cost !== ""){
                                youtube_shorts_cost = parseFloat(youtube_shorts_cost);
                                if(isNaN(youtube_shorts_cost) && typeof youtube_shorts_cost !== 'number'){
                                    alert("Please Enter Valid Numeric Data");
                                    $("#youtube_shorts_cost").focus();
                                }
                            }
                            if(contact_number !== "" && contact_number.length == 10){
                                if(contact_person_name !== ""){
                                    if(email_id !== ""){
                                        if(state !== ""){
                                            if(avg_views !== ""){
                                                 avg_views = parseInt(avg_views);
                                                 if(isNaN(avg_views) && typeof avg_views !== 'number'){
                                                     alert("Please Enter Valid Numeric Data");
                                                     $("#avg_views").focus();
                                                 }
                                            }
                                            if(avg_likes !== ""){
                                                avg_likes = parseInt(avg_likes);
                                                if(isNaN(avg_likes) && typeof avg_likes !== 'number'){
                                                    alert("Please Enter Valid Numeric Data");
                                                    $("#avg_likes").focus();
                                                }
                                            }
                                            if(influencer_name !== ""){
                                                if(campaign_done_earlier !== ""){
                                                    if(no_of_campaign !== ""){
                                                        if(influencer_category !== ""){
                                                            $.ajax({

                                                                url: 'addyoutube.php',
                                                                type: 'POST',
                                                                data:{channel_name:channel_name,
                                                                profile_url:profile_url,extension1:extension1,subscribers:subscribers,
                                                                genre:genre,language:language,gender:gender,
                                                                enlyft_exclusive:enlyft_exclusive,
                                                                integrated_video_cost:integrated_video_cost,
                                                                dedicated_video_cost:dedicated_video_cost,
                                                                youtube_story_cost:youtube_story_cost,
                                                                youtube_shorts_cost:youtube_shorts_cost,
                                                                contact_number:contact_number,contact_person_name:contact_person_name,
                                                                email_id:email_id,comment:comment,address:address,city:city,state:state,
                                                                avg_views:avg_views,avg_likes:avg_likes,influencer_name:influencer_name,
                                                                campaign_done_earlier:campaign_done_earlier,no_of_campaign:no_of_campaign,
                                                                influencer_category:influencer_category,name_of_client_worked_before:name_of_client_worked_before,
                                                                insertyoutube:"insertyoutube"},
                                                                beforeSend: function(){
                                                                    $('#insertyoutube').prop("disabled",true);
                                                                    $('#insertyoutube').text("Submitting....");
                                                                    $(".urlerror").css("display","none");
                                                                },
                                                                success: function(data){
                                                                    $('#insertyoutube').prop("disabled",false);
                                                                    $('#insertyoutube').text("Submit"); 
                                                                    if(data == 'success'){
                                                                        alert("Data Inserted Successfully");
                                                                        $("#addyoutube")[0].reset();
                                                                        $(".select2").val(null).trigger('change');
            //                                                            $("#state").val("");
            //                                                            $("#language").val("");
                                                                     }
                                                                    if(data == 'duplicate'){
                                                                        alert("Profile URL Already Exist, Please Enter Unique URL");
                                                                        $("#profile_url").focus();
                                                                        $(".urlerror").css("display","inline");
                                                                    }
                                                                    if(data == 'format'){
                                                                        alert("Please Enter Valid Profile URL Format");
                                                                        $("#profile_url").focus();
                                                                        $(".urlerror").css("display","inline");
                                                                        $(".urlerror").html("<strong class='text-danger'>Please Enter Valid Profile URL Format</strong>");
                                                                    }
                                                                    if(data == 'validurl'){
                                                                        alert("Profile URL Should Not End with /");
                                                                        $("#profile_url").focus();
                                                                        $(".urlerror").css("display","inline");
                                                                        $(".urlerror").html("<strong class='text-danger'>Profile URL Should Not End with /</strong>");
                                                                    }
                                                                    if(data == 'length'){
                                                                        alert("Profile URL ID Character Length Cannot Be Greater Than 24");
                                                                        $("#profile_url").focus();
                                                                        $(".urlerror").css("display","inline");
                                                                        $(".urlerror").html("<strong class='text-danger'>Profile URL ID Character Length Cannot Be Greater Than 24</strong>");
                                                                    }
                                                                    if(data == 'invalid'){
                                                                        alert("Please Fill All Numeric Fields Properly");
                                                                    }
                                                                    if(data == 'mandatory'){
                                                                        alert("Please Fill All Fields Properly");
                                                                    }
                                                                    if(data == 'fail'){
                                                                        alert("There was some while submitting, please try again later or contact website administrator");
                                                                    }
                                                                }
                                                            });
                                                        }
                                                        else{
                                                            alert("Please Select Influencer Category");
                                                            $("#influencer_category").focus();
                                                        }
                                                    }
                                                    else{
                                                        alert("Please Enter No. of Campaign");
                                                        $("#no_of_campaign").focus();
                                                    }
                                                }
                                                else{
                                                    alert("Please Select Campaign Done Earlier");
                                                    $("#campaign_done_earlier").focus();
                                                }
                                            }
                                            else{
                                                alert("Please Enter Influencer Name");
                                                $("#influencer_name").focus();
                                            }
                                        }
                                        else{
                                            alert("Please Select State");
                                            $("#state").focus();
                                        }
                                    }
                                    else{
                                        alert("Please Enter Email ID");
                                        $("#email_id").focus();
                                    }
                                }
                                else{
                                    alert("Please Enter Contact Person Name");
                                    $("#contact_person_name").focus();
                                }
                            }
                            else{
                                alert("Please Enter Valid 10 Digit Contact Number");
                                $("#contact_number").focus();
                            }
                        }
                        else{
                            alert("Please Select Enlyft Exclusive");
                            $("#enlyft_exclusive").focus();
                        }
                    }
                    else{
                        alert("Please Select Gender");
                        $("#gender").focus();
                    }
                }
                else{
                    alert("Please Select Language");
                    $("#language").focus();
                }
            }
            else{
                alert("Please Enter Profile URL");
                $("#profile_url").focus();
            }
        }
        else{
            alert("Please Enter Channel Name");
            $("#channel_name").focus();
        }
        return false;
    }
</script> 
   
