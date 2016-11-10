<?php

require 'includes/config.php';
require 'includes/aboutPage.class.php';
require 'includes/vcard.class.php';

$profile = new AboutPage($info);

if(array_key_exists('json',$_GET)){
	$profile->generateJSON();
	exit;
}
else if(array_key_exists('vcard',$_GET)){
	$profile->downloadVcard();
	exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="description" content="Online portfolio page of Gale Digital." />

		<title>Portfolio | Gale Digital</title>
		
		<link rel="stylesheet" href="assets/css/styles.css" />
		
		<!--[if lt IE 9]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-68120406-2', 'auto');
		  ga('send', 'pageview');

		</script>
	</head>
	
	<body>

		<section id="infoPage">
	
			<!--<img src="<?php echo $profile->photoURL()?>" alt="Gale Digital" width="164" height="164" />-->

			<header>
				<h1>Gale Digital</h1>
				<h2><?php echo $profile->tags()?></h2>
			</header>
			
			<p class="description">Welcome to the Gale Digital online portfolio. In this portfolio you will find of some of the websites/work Gale Digital has either fully produced or lead in development. For questions or additional samples please contact Marc Gale at <a href="mailto:mgale87@gmail.com">mgale87@gmail.com</a>.</p>
			
			<p class="description minus20">Aside from the production samples here, our capabilities are extensive. Some of our expertise includes website design & development, comprehensive internet marketing strategy, search engine optimization (SEO), pay per click (PPC), retargeting/remarketing, behavioral/contextual display, mobile website development, content writing & management, online PR, local search optimization (including directory listings), and more. 
			
			<div class="subject" style="margin-top:-20px;">
				<h2 class="subject">Websites</h2>
				<div class="break"></div>
				<p class="subject">Here you will find some of the websites Gale Digital has developed.</p>
			</div>
			<div class="inline-div">
				<h4>Corporate/Business</h4>
				<ul class="toc-list">
					<li><a href="http://www.thinkstrategic.com" target="_blank">Strategic Marketing, Inc.</a></li>
					<li><a href="http://www.thinksmartlink.com" target="_blank">SmartLink Internet Marketing, Inc.</a></li>
					<li><a href="http://thinksmartrep.com/" target="_blank">SmartRep Reputation Management</a></li>
					<li><a href="http://bluecho.satoridevelopment.com/blog/" target="_blank">Blu Echo Design</a></li>
					<li><a href="http://greyghostcharters.domainstockpile.com/" target="_blank">Grey Ghost Charters</a></li>
					<li><a href="http://192.185.75.72/~marcgale/pi/" target="_blank">Pi Audio/Visual</a> <abbr title="Work in progress, waiting on client content for buildout.">Note*</abbr></li>
				</ul>
			</div>

			<div class="inline-div">
				<h4>Services</h4>
				<ul class="toc-list">
				<li><a href="http://www.investproinc.com" target="_blank">InvestPro, Inc.</a>
						<ul class="sub">
							<li>Real-time MLS via IDX feed with robust features.</li>
						</ul>
					</li>
					<li><a href="https://www.arbresolutions.com/" target="_blank">Arbitration Resolution Services, Inc.</a></li>
					<li><a href="http://www.steemerofsouthflorida.com" target="_blank">Stanley Steemer of South Florida</a></li>
					<li><a href="http://www.holloranlaw.com" target="_blank">Holloran Schwartz &amp; Gaertner LLP</a></li>
					<li><a href="http://www.4bregman.com" target="_blank">Law Offices of Michael K. Bregman, P.A.</a></li>
					<li><a href="http://www.smparrishlaw.com" target="_blank">Steven M. Parrish, P.A.</a></li>
					<li><a href="http://192.185.76.180/~murphy17/staging/gfpc/" target="_blank">Guarantee Floridian Pest Control</a></li>
				</ul>
			</div>

			<div class="inline-div">
				<h4>Products</h4>
				<ul class="toc-list">
					<li><a href="http://silvaclear.com/" target="_blank">SilvaClear</a></li>
					<li><a href="http://corkdcandle.com/" target="_blank">CORK'D</a></li>
					<li><a href="http://192.185.76.137/~truetrea/" target="_blank">True Treasures, Inc.</a></li>
					<li><a href="http://www.candlesbybrandles.com" target="_blank">Brandles LLC</a></li>
					<li><a href="http://thescorpioniscoming.com" target="_blank">The Scoprion's Tale eBook</a></li>
					<li><a href="http://www.juvent.com" target="_blank">Juvent Landing Page/Portal</a></li>
					<li><a href="http://www.juventsports.com" target="_blank">Juvent Sports Division</a></li>
					<li><a href="http:/www.juventhealth.com" target="_blank">Juvent Health Division</a></li>
				</ul>
			</div>

			<div class="clear"></div>
			
			<div class="inline-div">
				<h4>Nonprofit & Other</h4>
				<ul class="toc-list">
					<li><a href="http://ourladyofflorida.org" target="_blank">Our Lady of Florida Spiritual Center</a></li>
					<li><a href="http://lml.satoridevelopment.com/" target="_blank">Love My Life Entertainment</a></li>
					<li><a href="http://www.besmartmusic.com" target="_blank">Be Smart</a></li>
					<li><a href="http://www.phoenixdatingforum.com" target="_blank">The Phoenix Dating Forum eRegistration</a></li>
					<li><a href="http://galedigital.com/portfolio/calc-sample/" target="_blank">Credit Card Rewards Calculator</a>
					<ul class="sub">
							<li>Claculator widget used to determine if your credit card's cash back rewards were a net gain or loss, given variables like your APR, balance, payments, etc. This demonstration lacks validation but is fully functional.</li>
						</ul>
					</li>
				</ul>
			</div>
			
			<div class="inline-div">
				<h4>Reputation Management App (MVC Architecture)</h4>
				<p class="subheading">Full-featured web application being developed to provide business owners with tools to manage/monitor online reviews, cultivate additional reviews, display reviews online, monitor employee ratings, and more.</p>
				<ul class="toc-list">
				
					<li><a href="http://i.imgur.com/QUGSzRY.png" target="_blank">Login Page</a>
						<ul class="sub">
							<li>All Model & Controller code is complete however the application has not launched at this time. Finishing touches are being applied to Views at every user level (Agency, Business, etc.). </li>
							</ul>
					</li>
					<li><a href="http://i.imgur.com/glR8FdI.png" target="_blank">Agency Dashboard</a></li>
					<li><a href="http://i.imgur.com/uOxuvR2.png" target="_blank">Agency Reporting by Client</a>
							<ul class="sub">
							<b>Note:</b> Live demo of application is available but, due to ongoing development and confidentiality concerns, the link/login is not public at this time.
							</ul>
					</li>
				</ul>
			</div>
			
			<div class="inline-div">
				<h4>Samples of Websites Under Development</h4>
				<ul class="toc-list">
					<li><a href="http://192.185.76.157/~weissmet/" target="_blank">Weiss Ratings Medigap Power Planner</a></li>
					<li><a href="http://192.185.76.157/~beachamp/" target="_blank">Be A Champion (Advocare International)</a></li>
					
					
				</ul>
			</div>

			<div class="clear"></div>

			<div class="subject">
				<h2 class="subject">Email Templates</h2>
				<div class="break"></div>
				<p class="subject">Templates are all designed &amp; developed to maximize email client compatability including utilizing inline CSS due to external stylesheets being unsupported by most clients.</p>
			</div>
			<div class="inline-div wide">
				<ul class="toc-list">
					<li><a href="http://thinkstrategic.com/eme/Excelleratormay.html" target="_blank">EmbroidMe</a>
						<ul class="sub">
							<li>Newsletter is sent to United Franchise Group's 200+ EmbroidMe franchisees as well as other affiliated people.</li>
						</ul>
					</li>
					<li><a href="http://thinksmartlink.com/staging/juvent-email/" target="_blank">Juvent Corporate</a>
						<ul class="sub">
							<li>Newsletter is sent to Juvent's investors and those interested in corporate updates.</li>
						</ul>
					</li>
					<li><a href="http://thinksmartlink.com/staging/juvent-email/" target="_blank">Juvent Sports</a>
						<ul class="sub">
							<li>Newsletter will be differentiated from corporate but utilize same structure for client's ease-of-use.</li>
						</ul>
					</li>
				</ul>
			</div>
			
			<div class="clear"></div>

			<div class="subject">
				<h2 class="subject" style="margin-top:20px;">Mobile Websites &amp; Landing Pages</h2>
				<div class="break"></div>
				<p class="subject">While responsive design is strongly favored, there have been instances where client needs called for a separate mobile website.</p>
			</div>
			<div class="inline-div wide">
				<ul class="toc-list">
					<li><a href="http://m.thinksmartlink.com/" target="_blank">SmartLink Marketing's Mobile Website</a></li>
					<li><a href="http://m.thinkstrategic.com/" target="_blank">Strategic Marketing's Mobile Website</a></li>
					<li><a href="http://blamstar.com/galedigital/EMe-Responsive-Redesign.pdf" target="_blank">EmbroidMe</a>
						<ul class="sub">
							<li>Link above opens PDF. This is a proposed redesigned of both EmbroidMe's corporate website (www.embroidme.com) as well as a proposed replacement to consolidate their 200+ individual store websites into a single, cohesive design (either as independent websites or integrated into the corporate site). The PDF first shows what the website looks like on desktop computers and then how its responsive code would serve the content up on a mobile device.</li>
						</ul>
					</li>
					<li><a href="http://emesocial.thinksmartlink.com/" target="_blank">EmbroidMe Social Media Content Program - Quick Start Guide</a>
						<ul class="sub">
							<li>The Quick Start Guide landing page is routinely used by EmbroidMe's 200+ franchisees as a reference and a tool for a social media program that we developed for them (more information on the program is available on the guide). The website serves as an example of utilizing a grid layout, simple imagery, and clean typography that delivers critical information in an easy-to-use format that puts user experience first.</li>
						</ul>
					</li>
				</ul>
			</div>
			
			<div class="clear"></div>

			<div class="subject">
				<h2 class="subject" style="margin-top:20px;">Plugins &amp; Scripting</h2>
				<div class="break"></div>
				<p class="subject"></p>
			</div>
			<div class="inline-div">
				<p>feedBloom - Wordpress Plugin</p>
				<ul class="toc-list">
					<li><a href="plugin-feedbloom.phps" target="_blank">Plugin Init Script</a>
						<ul class="sub">
							<li>A wordpress plugin that scrapes RSS feeds for articles matching desired keywords, follows their source, pulls in the full article content and outputs the results in a new RSS feed.</li>
						</ul>
					</li>
					<li><a href="images/feedbloom-feeds.png" target="_blank">Screenshot 01</a>
						<ul class="sub">
							<li>This is a screenshot of the backend feed summary page.</li>
						</ul>
					</li>
					<li><a href="images/feedbloom-edit.png" target="_blank">Screenshot 02</a>
						<ul class="sub">
							<li>This is a screenshot of the form for adding new/editing existing feeds.</li>
						</ul>
					</li>
				</ul>
			</div>
			
			<div class="inline-div">
				<p>Fetch Factual - Wordpress Plugin</p>
				<ul class="toc-list">
					<li><a href="fetch-factual.phps" target="_blank">Plugin Init Script</a>
						<ul class="sub">
							<li>A wordpress pluging that condenses demographics data for a supplied longitude &amp; latitude.  The plugin is executed using AJAX so it can deliver the data without the need for the users page to refresh. It calls 3 different API's to combine location data, census data &amp; business data then outputs the results with jQuery graphs.</li>
						</ul>
					</li>
					<li><a href="fetch-factual.txt" target="_blank">Javascript Sample</a>
						<ul class="sub">
							<li>This is a segment of the javascript executed during the API calls.</li>
						</ul>
					</li>
					<li><a href="fetch-factual-style.txt" target="_blank">CSS Sample</a>
						<ul class="sub">
							<li>This is one of the style sheets used for Fetch Factual's user alert system.</li>
						</ul>
					</li>
				</ul>
			</div>
			
			<div class="inline-div">
				<p>Other Scripting Samples</p>
				<ul class="toc-list">
					<li><a href="bread-crumb.phps" target="_blank">Bread Crumb</a>
						<ul class="sub">
							<li>A PHP helper class to generate dynamic site bread crumbs.</li>
						</ul>
					</li>
					<li><a href="ajax-xml-parse.txt" target="_blank">Javascript AJAX XML Parser</a>
						<ul class="sub">
							<li>These are some basic AJAX functions used for an xml parser.</li>
						</ul>
					</li>
					<li><a href="domains.xml" target="_blank">Dynamic XML</a>
						<ul class="sub">
							<li>This is an XML file that is dynamically managed with PHP & javascript.</li>
						</ul>
					</li>
				</ul>
			</div>
			
		</section>

		<section id="links">
			<p>All Rights Reserved. © Gale Digital 2014 - <?php echo date("Y") ?></p>
		</section>
		
		<!--<footer>

		</footer>-->
		  
	</body>
</html>
