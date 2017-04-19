<?php  
session_start();  
  
if(!$_SESSION['Username'])  
{  
  
    header("Location: index.html");//redirect to login page to secure the welcome page without login access.  
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
	         <a href="home1.php">Librero</a>
	      </div>

	   	<nav id="main-nav-wrap">
				<ul class="main-navigation">
					<li class="current"><a class="smoothscroll"  href="#intro" title="">Home</a></li>
					<li><a class="smoothscroll"  href="#process" title="">Return</a></li>
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
$date1=$_POST['ret_date'];
//$date2= date('d-m-Y',strtotime($date1 . " +29 days"));
$code=$_POST['code'];

$sql1 = "delete from `issue` where `book_id`='$bookid' AND `Username`='$uid' AND `subject_code`='$code' ";
$sth = $conn->prepare("SELECT date_of_return FROM issue WHERE book_id = :id AND Username= :uid");
$sth->bindValue(':id', $bookid);
$sth->bindValue(':uid',$uid);
$sth->execute();
$result = $sth->fetchColumn();

$sths = $conn->prepare("SELECT fine FROM issue WHERE book_id = :id AND Username= :uid");
//echo $sql2;
$sths->bindValue(':id', $bookid);
$sths->bindValue(':uid',$uid);
$sths->execute();
$result1 = $sths->fetchColumn();
         
$my_date1 = date('d/m/y', strtotime($date1));
$my_date2 = date('d/m/y', strtotime($result));
list($d1, $m1, $y1) = explode('-', $date1);
list($d2, $m2, $y2) = explode('-', $result);
if(($m2==$m1) && ($d1 < $d2))
{
echo "No Fine";
$fine=0;
}
else
{
$diff = abs($my_date1 - $my_date2);
$fine=$diff*10;
echo "\n <h3>Fine =" . $fine . "</h3>"; 
}
$result1=$result1+$fine;
echo "Total Fine =" . $result1;
$f=(string)$result1;
//echo $bookid;
$var=' UPDATE fine SET fine = :id WHERE Username = :uid ';
$stmt = $conn->prepare($var);
$stmt->bindValue(':id', $f);
$stmt->bindValue(':uid', $uid);
$stmt->execute();

if($conn->query($sql1)) {
       // print "Returned" ;  
   }
$var1=' UPDATE books SET issued = :id WHERE book_id = :bid ';
$stmt1 = $conn->prepare($var1);
$stmt1->bindValue(':id', "F");
//$stmt1->bindValue(':uid', $uid);
$stmt1->bindValue(':bid', $bookid);
$stmt1->execute();
//$statement = $conn->prepare("INSERT INTO `issue` (`book_id`,`Username`,`date_of_issue`,`subject_code`,`date_of_return`,`fine`)
  //  VALUES(?, ?, ?,?,?,?)");


$conn=null;





?>
	   			
	   			
	   			</h5>

	   			<h1><p>Returned</p></h1>
	   			


           <!--    <button type="button">Check Availability!</button>
                <form action="index.html" method="post">
      
                  <h1>ISSUE</h1>
                  <fieldset>
                     <label for="Book Id">Book Id:</label>
                     <input type="text" id="name" name="Book Id">
                     <label for="username">User Name:</label>
                     <input type="text" id="name" name="username">
                     <label for="iss_date">Date of Issue:</label>
                     <input type="date" id="name" name="iss_date">
          
                  </fieldset>
                  <fieldset>
                     <label for="Category">Category:</label>
                     <select id="cate" name="book">
                        <option value="CSE">Computer Science and Engineering</option>
                        <option value="ECE">Electronics and Communication Engineering</option>
                        <option value="HSS">Humanities</option>
                        <option value="MAG">Magazines and Journals</option>
                        <option value="MATH">Mathematics</option>
                     </select>
                   </fieldset>
                  <fieldset><button type="submit">Do It !</button></fieldset>
               </form>-->
   					
   			</div>
   				
   		</div> <!-- /left-side -->
   		
   		<!--<div class="right-side">
   				
   			<div class="item" data-item="3">

   				<h5>Return</h5>

   				<p>One can return the book through this when their work is completed or their timelimit has been ended.This will help Librarian in keeping records of the books in Library and maintain books.</p>
   				<button type="button">Return!</button>	
   			</div>

   			<div class="item" data-item="4">

   				<h5>Pay Fine</h5>

   				<p>In this all issuers can pay fine in one step here by some means of payment gateways and hence reduces the human work.
               <button type="button">Pay Fine!</button>
               </p>
   					
   			</div>

   		</div> --><!-- /right-side -->  

   		<div class="image-part"></div>  			

   	</div> <!-- /process-content --> 

   </section> <!-- /process-->    


   <!-- features Section
   ================================================== -->
	<!--<section id="features">

		<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h5>Features</h5>
   			<h1>Great features you'll love.</h1>

   			<p class="lead">Lorem ipsum Do commodo in proident enim in dolor cupidatat adipisicing dolore officia nisi aliqua incididunt Ut veniam lorem ipsum Consectetur ut in in eu do.</p>

   		</div>   		
   	</div>

   	<div class="row features-content">

   		<div class="features-list block-1-3 block-s-1-2 block-tab-full group">

	      	<div class="bgrid feature">	

	      		<span class="icon"><i class="icon-window"></i></span>            

	            <div class="service-content">	

	            	 <h3 class="h05">Fully Resposive</h3>

		            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
	         		</p>
	         		
	         	</div> 	         	 

				</div>--> <!-- /bgrid -->

				<!--<div class="bgrid feature">	

					<span class="icon"><i class="icon-eye"></i></span>                          

	            <div class="service-content">	
	            	<h3 class="h05">Retina Ready</h3>  

		            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
	         		</p>

	         		
	            </div>	                          

			   </div>--> <!-- /bgrid -->

			   <!--<div class="bgrid feature">

			   	<span class="icon"><i class="icon-paint-brush"></i></span>		            

	            <div class="service-content">
	            	<h3 class="h05">Stylish Design</h3>

		            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
	        			</p> 

	        			
	            </div> 	            	               

			   </div>--> <!-- /bgrid -->

				<!--<div class="bgrid feature">

					<span class="icon"><i class="icon-file"></i></span>	              

	            <div class="service-content">
	            	<h3 class="h05">Clean Code</h3>

		            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
	         		</p> 

	         		
	            </div>                

				</div>--> <!-- /bgrid -->

			   <!--<div class="bgrid feature">

			   	<span class="icon"><i class="icon-layers"></i></span>	            

	            <div class="service-content">	
	            	<h3 class="h05">Easy To Customize</h3>

		            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
	        			</p> 

	        			
	            </div>	               

			   </div>--> <!-- /bgrid -->

			   <!--<div class="bgrid feature">

			   	<span class="icon"><i class="icon-gift"></i></span>	   	           

	            <div class="service-content">
	            	 <h3 class="h05">Free of Charge</h3>

		            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
	        			</p> 
	        			
	            </div>	               

			   </div>--> <!-- /bgrid -->

	      <!--</div>--> <!-- features-list -->
   		
   	<!--</div>--> <!-- features-content -->
		
	<!--</section>--> <!-- /features -->
	

	<!-- pricing
   ================================================== -->

   <!--<section id="pricing">

   	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h5>Our Pricing</h5>
   			<h1>Pick the best plan for you.</h1>

   			<p class="lead">Lorem ipsum Do commodo in proident enim in dolor cupidatat adipisicing dolore officia nisi aliqua incididunt Ut veniam lorem ipsum Consectetur ut in in eu do.</p>

   		</div>   		
   	</div>

   	<div class="row pricing-content">

         <div class="pricing-tables block-1-4 group">

            <div class="bgrid"> 

            	<div class="price-block">

            		<div class="top-part">

	            		<h3 class="plan-title">Starter</h3>
		               <p class="plan-price"><sup>$</sup>4.99</p>
		               <p class="price-month">Per month</p>
		               <p class="price-meta">Billed Annually.</p>

	            	</div>                

	               <div class="bottom-part">

	            		<ul class="features">
		                  <li><strong>3GB</strong> Storage</li>
		                  <li><strong>10GB</strong> Bandwidth</li>		                  
		                  <li><strong>5</strong> Databases</li>		                  
		                  <li><strong>30</strong> Email Accounts</li>
		               </ul>

		               <a class="button large" href="">Get Started</a>

	            	</div>

            	</div>           	
                        
			   </div>--> <!-- /price-block -->

            <!--<div class="bgrid">

            	<div class="price-block primary">

            		<div class="top-part" data-info="recommended">

	            		<h3 class="plan-title">Standard</h3>
		               <p class="plan-price"><sup>$</sup>9.99</p>
		               <p class="price-month">Per month</p>
							<p class="price-meta">Billed Annually.</p>

	            	</div>               

	               <div class="bottom-part">

	            		<ul class="features">
		                  <li><strong>5GB</strong> Storage</li>
		                  <li><strong>15GB</strong> Bandwidth</li>		                  
		                  <li><strong>7</strong> Databases</li>		                  
		                  <li><strong>40</strong> Email Accounts</li>
		               </ul>

		               <a class="button large" href="">Get Started</a>

	            	</div>
            		
            	</div>            	                 

			  </div>--> <!-- /price-block -->

           <!--<div class="bgrid">               

               <div class="price-block">

            		<div class="top-part">

	            		<h3 class="plan-title">Premium</h3>
		               <p class="plan-price"><sup>$</sup>19.99</p>
		               <p class="price-month">Per month</p>
		                <p class="price-meta">Billed Annually.</p>		               

	            	</div> 
	            	
						<div class="bottom-part">

	            		<ul class="features">
		                  <li><strong>10GB</strong> Storage</li>
		                  <li><strong>30GB</strong> Bandwidth</li>		                  
		                  <li><strong>15</strong> Databases</li>		                  
		                  <li><strong>60</strong> Email Accounts</li>
		               </ul>

		               <a class="button large" href="">Get Started</a>

	            	</div>	            		                
            		
            	</div>                              

			   </div>--> <!-- /price-block --> 

			   <!--<div class="bgrid">               

               <div class="price-block">

            		<div class="top-part">

	            		<h3 class="plan-title">Ultimate</h3>
		               <p class="plan-price"><sup>$</sup>29.99</p>
		               <p class="price-month">Per month</p>
		               <p class="price-meta">Billed Annually.</p>		               

	            	</div> 
	            	
						<div class="bottom-part">

	            		<ul class="features">
		                  <li><strong>20GB</strong> Storage</li>
		                  <li><strong>40GB</strong> Bandwidth</li>		                  
		                  <li><strong>25</strong> Databases</li>		                  
		                  <li><strong>100</strong> Email Accounts</li>
		               </ul>

		               <a class="button large" href="">Get Started</a>

	            	</div>	            		                
            		
            	</div>                              

			   </div> --><!-- /price-block -->           

         <!--</div>--> <!-- /pricing-tables --> 

      <!--</div>--> <!-- /pricing-content --> 

   <!--</section>--> <!-- /pricing --> 


   <!-- Testimonials Section
   ================================================== -->
 


   <!-- faq
   ================================================== -->
   <!--<section id="faq">

   	<div class="row section-intro">
   		<div class="col-twelve with-bottom-line">

   			<h5>Faq</h5>
   			<h1>Questions and Answers.</h1>

   			<p class="lead">Lorem ipsum Do commodo in proident enim in dolor cupidatat adipisicing dolore officia nisi aliqua incididunt Ut veniam lorem ipsum Consectetur ut in in eu do.</p>

   		</div>   		
   	</div>

   	<div class="row faq-content">

   		<div class="q-and-a block-1-2 block-tab-full group">

   			<div class="bgrid">

   				<h3>What are the security features?</h3>

   				<p>Lorem ipsum Id in magna ad culpa dolor eu aute non amet aute ea in consectetur in quis nostrud anim proident dolore in sed et mollit voluptate culpa irure consequat laborum ea sint in mollit adipisicing cupidatat.</p>

   			</div>

   			<div class="bgrid">

   				<h3>How can I update my user profile?</h3>

   				<p>Lorem ipsum Id in magna ad culpa dolor eu aute non amet aute ea in consectetur in quis nostrud anim proident dolore in sed et mollit voluptate culpa irure consequat laborum ea sint in mollit adipisicing cupidatat.</p>

   			</div>

   			<div class="bgrid">

   				<h3>What features are not included in the free version?</h3>

   				<p>Lorem ipsum Id in magna ad culpa dolor eu aute non amet aute ea in consectetur in quis nostrud anim proident dolore in sed et mollit voluptate culpa irure consequat laborum ea sint in mollit adipisicing cupidatat.</p>

   			</div>

   			<div class="bgrid">

   				<h3>Can I upgrade my account from Starter to Premium?</h3>

   				<p>Lorem ipsum Id in magna ad culpa dolor eu aute non amet aute ea in consectetur in quis nostrud anim proident dolore in sed et mollit voluptate culpa irure consequat laborum ea sint in mollit adipisicing cupidatat.</p>

   			</div>

   			<div class="bgrid">

   				<h3>Where can I found all my uploads?</h3>

   				<p>Lorem ipsum Id in magna ad culpa dolor eu aute non amet aute ea in consectetur in quis nostrud anim proident dolore in sed et mollit voluptate culpa irure consequat laborum ea sint in mollit adipisicing cupidatat.</p>

   			</div>

   			<div class="bgrid">

   				<h3>How long can I use the free trial version?</h3>

   				<p>Lorem ipsum Id in magna ad culpa dolor eu aute non amet aute ea in consectetur in quis nostrud anim proident dolore in sed et mollit voluptate culpa irure consequat laborum ea sint in mollit adipisicing cupidatat.</p>

   			</div>

   		</div> --><!-- /q-and-a --> 
   		
   	<!--</div>--> <!-- /faq-content --> 

   	<!--<div class="row section-ads">

		   <div class="col-twelve">	

		     	<div class="ad-content">

		     		<h2 class="h01"><a href="http://www.dreamhost.com/r.cgi?287326|STYLESHOUT">Styleshout Recommends Dreamhost.</a></h2>

			      <p class="lead">
			      Looking for an awesome and reliable webhosting? Try <a href="http://www.dreamhost.com/r.cgi?287326|STYLESHOUT"><span>DreamHost</span></a>.
					Get <span>$50 off</span> when you sign up with the promocode <span>styleshout</span>. 
					--><!-- Simply type	the promocode in the box labeled “Promo Code” when placing your order. -->					
					<!--</p>

					<div class="action">
			         <a class="button large round" href="http://www.dreamhost.com/r.cgi?287326|STYLESHOUT">Sign Up Now</a>
		        	</div>

		     	</div>			      

			</div>

		</div>--> <!-- /section-ads --> 


   <!--</section>--> <!-- /faq --> 

   <!-- cta
   ================================================== -->
   <!--<section id="cta">

   	<div class="row cta-content">

   		<div class="col-twelve">

   			<h1 class="h01">Get started now. Try Lhander free for 30 days.</h1>

   			<p class="lead">Download the app now. Available on the:</p>

   			<ul class="stores">
   				<li class="app-store">
   					<a href="#" class="button round large" title="">
   						<i class="icon ion-social-apple"></i>App Store
   					</a>
   				</li>
   				<li class="play-store">
   					<a href="#" class="button round large" title="">
   						<i class="icon ion-social-android"></i>Play Store</a>
   					</li>
   				<li class="windows-store">
   					<a href="#" class="button round large" title="">
   						<i class="icon ion-social-windows"></i>Win Store</a>
   					</li>
   			</ul>

   		</div>

   	</div>--> <!-- /cta-content -->

   <!--</section>--> <!-- /cta -->


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
