/*!
 * Reviews JQuery version 0.1.0
 * http://jquery.com/
 * Copyright 2005, 2013 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 * Author:yogendra Kumar <mss.yogendra@gmail.com>
 * Date: 23-03-2015
 */
function fetchReviews(url,b)
{
	//console.log(option[0]);
	BusinessId=b;	URL=url;		
	var element = document.createElement("link");
	element.setAttribute("rel", "stylesheet");
	element.setAttribute("type", "text/css");
	element.setAttribute("href", url+"/css/review.css");
	document.getElementsByTagName("head")[0].appendChild(element);	
	var HTML='<div class="reviews_container"><section id="reviewheader"></section><section id="reviewcontent"></section><section id="reviewfooter"></section></div>';
	 document.getElementById("reputation").innerHTML=HTML;	
	 Request(url+'public/onlineReviewPlugin/'+b+'/1');
	
}
function Request(url)
{
	 
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
			//Format JSON
			var insertHtml=JSON.parse(xmlhttp.responseText);
			BusinessHeader(insertHtml.business,url);
			BusinessFooter(url);
			BusinessContent(insertHtml.reviews,url);
	    }
	  }
	//if(page>0){url=url+'public/fetchReviews/?id='+BusinessId;}
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

///////// Format Business Header

function BusinessHeader(businessdetail,url)
{
	
	 if(businessdetail.logo!=''){
			var blogo='<img src="'+url+'/img/'+businessdetail.logo+'">';
		}
		else{
			var blogo='<span>'+businessdetail.name+'</span>';
			}
	var html='<div class="business_detail">'+blogo+' <br> <h2>'+businessdetail.name+'</h2><hr><p>'+businessdetail.description+'</p><br><p>'+businessdetail.address+'</p></div>';
	var e=document.getElementById("reviewheader");	
	e.innerHTML=html;
	return true;
}
// Format content
function BusinessContent(reviews)
{
		var HTML='';
		var arr = [];
		for(var x in reviews){
			HTML+='<div class="review">';
			HTML+='<div class="cname">'+'<img src="'+reviews[x]['img']+'"><h2>'+reviews[x]['cname']+'</h2>'+reviews[x]['date']+'</div>';
			HTML+='<img src="'+reviews[x]['ratingstar']+'">';
			HTML+='<div class="rdescriptioin">'+reviews[x]['ratingdescription']+'</div>';
			HTML+='</div>';
		}
		if(HTML==''){HTML="There are no Reviews;";return;}
		var e=document.getElementById("reviewcontent");	
		e.innerHTML=e.innerHTML+HTML;
}
///footer content
function BusinessFooter(url)
{
	
  var page=parseInt(url.slice(-1))+1;
	url = url.substring(0, url.length - 2); 




	var href='href="'+url+'/'+page+'"';		
	var f='Request(this.href);return false;';
        var html='<div class="load_more"><a onclick="'+f+'"'+href+'>Load More</a></div>';
         var e=document.getElementById("reviewfooter");	
	e.innerHTML=html;
}

