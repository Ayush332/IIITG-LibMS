<?php  
session_start();  
  
if(!$_SESSION['Username'])  
{  
  
    header("Location: home.php");//redirect to login page to secure the welcome page without login access.  
}  
  
?>  

<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>Librero</title>
	<meta name="description" content="">  
	<meta name="author" content="">

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- CSS
   ================================================== -->
   <link rel="stylesheet" href="css/base.css">  
   <link rel="stylesheet" href="css/main.css">
   <link rel="stylesheet" href="css/vendor.css">
   <link rel="stylesheet" href="ava.css">     

   <!-- script
   ================================================== -->
	<script src="js/modernizr.js"></script>

   <!-- favicons
	================================================== -->
	<link rel="icon" type="image/png" href="favicon.png">

</head>

<body id="top">

	<!-- header 
   ================================================== -->
   <header>

   	<div class="row">

   		<div class="logo">
	         <a href="home.php">Librero</a>
	      </div>

	   	<nav id="main-nav-wrap">
				<ul class="main-navigation">
					<li class="current"><a class="smoothscroll"  href="#intro" title="">Home</a></li>
					<li><a class="smoothscroll"  href="#process" title="">Re-issue</a></li>
					<li><a class="smoothscroll"  href="#" title=""></a><?php  echo $_SESSION['Username'];  ?></li>
					<!--<li><a class="smoothscroll"  href="#features" title="">Features</a></li>-->
					<!--<li><a class="smoothscroll"  href="#pricing" title="">Pricing</a></li>
					<li><a class="smoothscroll"  href="#faq" title="">FAQ</a></li>-->					
					<li class="highlight with-sep"><a href="logout.php" title="Sign Out">Sign Out</a></li>					
				</ul>
			</nav>

			<a class="menu-toggle" href="#"><span>Menu</span></a>
   		
   	</div>   	
   	
   </header> <!-- /header -->

	<!-- intro section
   ================================================== -->
   <section id="intro">

   	<div class="shadow-overlay"></div>

   	<div class="intro-content">
   		<div class="row">

   			<div class="col-twelve">

	   			<!--<div class='video-link'>
	   				<a href="#video-popup"><img src="images/play-button.png" alt=""></a>
	   			</div>-->

	   			<h5>Hello welcome to Librero.</h5>
	   			<h1>One stop solution to all your study interests.</h1>

	   			<a class="button stroke smoothscroll" href="#process" title="">Excited</a>

	   		</div>  
   			
   		</div>   		 		
   	</div> 

   	<!-- Modal Popup
	   ========================================================= -->

      <!--<div id="video-popup" class="popup-modal mfp-hide">

		   <div class="fluid-video-wrapper">
            <iframe src="http://player.vimeo.com/video/14592941?title=0&amp;byline=0&amp;portrait=0&amp;color=faec09" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
         </div>		     

         <a class="close-popup">Close</a>         

	   </div>--> <!-- /video-popup -->  	 	

   </section> <!-- /intro -->


   <!-- Process Section
   ================================================== -->
   <section id="process">  

   	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<!--<h5>Process</h5>
   			<h1>How it works?</h1>

   			<p class="lead">In this you can find your all needs fulfilled by only one step solution on Librero. It asks you about the book you want to issue and issue respective book and helps you in your studies.</p>

   		</div>   		
   	</div>

   	<div class="row process-content">

   		<div class="left-side">

   			<div class="item" data-item="1">

   				<h5>Log-In/Sign Up</h5>

   				<p>Here you can log into your account and do your work. Whether You are Librarian, a faculty, a student or a research scholar, all your work will be done through just logging into this.</p>
   				 	
   			</div>-->

   			<div class="item" data-item="1">

	   			<h5>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "ayush";
$dbname = "library";
//require 'core.inc.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$bookid=$_POST['id'];
$uid=$_POST['username'];
$date1=$_POST['iss_date'];
$date2= date('d-m-Y',strtotime($date1 . " +29 days"));
$code=$_POST['code'];

$fine=0;
$var=' UPDATE issue SET date_of_issue = :id , date_of_return = :id2 WHERE book_id = :Bid AND Username=:Uid ';
$statement = $conn->prepare($var);

//echo $uid;
$statement->bindValue(':id', $date1);
//Bind our :model parameter.
$statement->bindValue(':id2', $date2);
$statement->bindValue(':Bid', $bookid);
$statement->bindValue(':Uid', $uid);
$statement->execute() ;  


#$statement->execute(array($bookid,$uid,$date1,$code,$date2,"0")) or die(print_r($statement->error_info(), true));
#$sql1 = "insert into issue(book_id,Username,date_of_issue,subject_code,date_of_return,fine) values ($bookid,$uid,$date1,?,?,0) ";

$conn=null;
?>
	   			
	   			
	   			</h5>

	   			<h1><p>Re-Issued</p></h1>
	   			


   					
   			</div>
   				
   		</div> 

   		<div class="image-part"></div>  			

   	</div> <!-- /process-content --> 

   </section> <!-- /process-->    




 


   <!-- footer
   ================================================== -->
   <footer>

   	<div class="footer-main">

   		<div class="row">  

	      	<div class="col-four tab-full mob-full footer-info">            

	            <div class="footer-logo"></div>

	            <p>
		        	IIIT Guwahati,Ambari<br>
            	Guwahati, Assam 781001 India<br>
		        	Sri.ayush1401012@gmail.com &nbsp; +91-9453585969
		        	</p>

		      </div> <!-- /footer-info -->

	      	<div class="col-two tab-1-3 mob-1-2 site-links">

	      		<h4>Site Links</h4>

	      		<ul>
	      			<li><a href="#">About Us</a></li>
						<!--<li><a href="#">Blog</a></li>-->
						<!--<li><a href="#">FAQ</a></li>-->
						<li><a href="#">Terms</a></li>
						<li><a href="#">Privacy Policy</a></li>
					</ul>

	      	</div> <!-- /site-links -->  

	      	<div class="col-two tab-1-3 mob-1-2 social-links">

	      		<h4>Social</h4>

	      		<ul>
	      			<li><a href="#">Twitter</a></li>
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Dribbble</a></li>
						<li><a href="#">Google+</a></li>
						<li><a href="#">Skype</a></li>
					</ul>
	      	           	
	      	</div> <!-- /social --> 

	      	<div><!--<div class="col-four tab-1-3 mob-full footer-subscribe">

	      		<h4>Subscribe</h4>

	      		<p>Keep yourself updated. Subscribe to our newsletter.</p>

	      		<div class="subscribe-form">
	      	
	      			<form id="mc-form" class="group" novalidate="true">

							<input type="email" value="" name="dEmail" class="email" id="mc-email" placeholder="type email &amp; hit enter" required=""> 
	   		
			   			<input type="submit" name="subscribe" >
		   	
		   				<label for="mc-email" class="subscribe-message"></label>
			
						</form>

	      		</div>	      		
	      	           	
	      	</div>--></div> <!-- /subscribe -->         

	      </div> <!-- /row -->

   	</div> <!-- /footer-main -->


      <div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>© Copyright Librero 2017.</span> 
		         	<span>Design by <a href="http://www.iiitg.ac.in/">Team Librero</a></span>		         	
		         </div>

		         <div id="go-top" style="display: block;">
		            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon ion-android-arrow-up"></i></a>
		         </div>         
	      	</div>

      	</div> <!-- /footer-bottom -->     	

      </div>

   </footer>  

   <div id="preloader"> 
    	<div id="loader"></div>
   </div> 

   <!-- Java Script
   ================================================== --> 
   <script src="js/jquery-1.11.3.min.js"></script>
   <script src="js/jquery-migrate-1.2.1.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/main.js"></script>

</body>

</html>
