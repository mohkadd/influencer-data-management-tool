<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--    <link rel="stylesheet" href="assets/css/style.css">-->
</head>
<style>
body {
    background: #e9ecef;
/*    background-color: #f9f9fa*/
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden;
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
    box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
    border: none;
    margin-bottom: 30px;
}

.m-r-0 {
    margin-right: 0px;
}

.m-l-0 {
    margin-left: 0px;
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px;
}

.bg-c-lite-green {
    background: black;
/*
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263);
*/
}

.user-profile {
    padding: 20px 0;
}

.card-block {
    padding: 1.25rem;
}

.m-b-25 {
    margin-bottom: 25px;
}

.img-radius {
    border-radius: 5px;
}


 
h6 {
    font-size: 14px;
    color: red;
}

.card .card-block p {
    line-height: 25px;
}

@media only screen and (min-width: 1400px){
p {
    font-size: 14px;
}
}

.card-block {
    padding: 1.25rem;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.m-b-20 {
    margin-bottom: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.card .card-block p {
    line-height: 25px;
}

.m-b-10 {
    margin-bottom: 10px;
}

.text-muted {
    color: #919aa3 !important;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.f-w-600 {
    font-weight: 600;
}

.m-b-20 {
    margin-bottom: 20px;
}

.m-t-40 {
    margin-top: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.m-b-10 {
    margin-bottom: 10px;
}

.m-t-40 {
    margin-top: 20px;
}

.user-card-full .social-link li {
    display: inline-block;
}

.user-card-full .social-link li a {
    font-size: 17px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}



    
</style>
<?php
include "config-pdo.php";
include "functions/functions.php";
$API_Key = 'AIzaSyClR56gbTmK3BhSka8UdrV8bjLYmJYHqSk';
$pdf_data = "SELECT * FROM youtube";
$stmt1 = $con->prepare($pdf_data);
$stmt1->execute();    
?>
<body>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
               
               <?php 
                while($row = $stmt1->fetch()){
                    $url = explode("/", decrypt($row->profile_url)); // convert string into separate array elements after every /
                    $channelID = end($url);
                    $json_details = json_decode(file_get_contents("https://youtube.googleapis.com/youtube/v3/channels?part=snippet&part=statistics&id=$channelID&key=$API_Key"),true);    
                    $channelimg =  $json_details['items'][0]['snippet']['thumbnails']['default']['url'];
//                    echo $channelimg."<br>";
                ?>
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="<?php echo $channelimg ?>" class="img-radius" alt="User-Profile-Image">
                                    </div>
                                    <p><?php echo decrypt($row->channel_name) ?></p>
                                    <h6 class="f-w-600">Technology</h6><br>
                                    <div class="row f-w-600" style="font-size:13px;">
                                        <div class="col-sm-4">
                                            Subscribers<br>
                                            <i class="fa fa-youtube-play m-t-10 f-16" style="color:red;"></i><br>
                                            <?php echo number_format($row->subscribers); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            Avg Views<br>
                                            <i class="fa fa-eye m-t-10 f-16" style="color:red;"></i><br>
                                            <?php echo number_format($row->avg_views); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            Avg Likes<br>
                                            <i class="fa fa-thumbs-up m-t-10 f-16" style="color:red;"></i><br>
                                            <?php echo number_format($row->avg_likes); ?>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <p class="m-b-10 f-w-600">Gender</p>
                                            <h6 class="text-muted f-w-400"><?php echo $row->gender; ?></h6>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="m-b-10 f-w-600">Language</p>
                                            <h6 class="text-muted f-w-400"><?php echo ucwords($row->language); ?></h6>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="m-b-10 f-w-600">Category</p>
                                            <h6 class="text-muted f-w-400"><?php echo strtoupper($row->influencer_category); ?></h6>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="m-b-10 f-w-600">ENLYFT Exclusive</p>
                                            <h6 class="text-muted f-w-400"><?php echo ucwords(decrypt($row->enlyft_exclusive)); ?></h6>
                                        </div>
                                    </div>
                                    <hr>
<!--                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6>-->
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <p class="m-b-10 f-w-600">City</p>
                                            <h6 class="text-muted f-w-400"><?php echo ucwords($row->city); ?></h6>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="m-b-10 f-w-600">State</p>
                                            <h6 class="text-muted f-w-400"><?php echo ucwords($row->state); ?></h6>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="m-b-10 f-w-600">No. of Campaign</p>
                                            <h6 class="text-muted f-w-400"><?php echo decrypt($row->no_of_campaign); ?></h6>
                                        </div>
                                    </div>
                                    <hr>
<!--
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="m-b-10 f-w-600">Recent</p>
                                            <h6 class="text-muted f-w-400">Sam Disuja</h6>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="m-b-10 f-w-600">Most Viewed</p>
                                            <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                        </div>
                                    </div>
-->
                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="<?php echo decrypt($row->profile_url) ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true">Visit Channel <i class="fa fa-link feather icon-facebook facebook" aria-hidden="true"></i></a></li>
<!--
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="fa fa-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="fa fa-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php    
                }
                ?>
                
                
                
                
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>