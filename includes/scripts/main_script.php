<script type="text/javascript" src="../jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	function Hi(e,obj){obj.css('display','inline').css('left',e.pageX+25).css('top',e.pageY);}
	function Ho(obj){obj.css('display','none');}

	$("document").ready(function(){
		exp=$("#exp");expQ=$("#expQ");expT=$("#expT");cus=$("#cus");cusQ=$("#cusQ");cusT=$("#cusT");pasQ=$("#pasQ");pasT=$("#pasT");urlQ=$("#urlQ");urlT=$("#urlT");rid=$("#rid");ridQ=$("#ridQ");ridT=$("#ridT");
		expQ.css('display','inline');cusQ.css('display','inline');pasQ.css('display','inline');urlQ.css('display','inline');ridQ.css('display','inline');
		exp.css('visibility','hidden');cus.css('display','none');rid.css('display','none');

		cusQ.hover(function(e){Hi(e,cusT);},function(){Ho(cusT);});
		expQ.hover(function(e){Hi(e,expT);},function(){Ho(expT);});
		pasQ.hover(function(e){Hi(e,pasT);},function(){Ho(pasT);});
		urlQ.hover(function(e){Hi(e,urlT);},function(){Ho(urlT);});
		ridQ.hover(function(e){Hi(e,ridT);},function(){Ho(ridT);});

		$("input:checkbox[name='expiration']").click(function(){
			if(this.checked){exp.css('visibility','visible');expQ.css('display','none');}
			else{exp.css('visibility','hidden');expQ.css('display','inline');}
		});

		$("input:checkbox[name='custom']").click(function(){
			if(this.checked){cus.css('display','inline');cusQ.css('display','none');}
			else{cus.css('display','none');cusQ.css('display','inline');}
		});

		$("input:checkbox[name='riddle']").click(function(){
			if(this.checked){rid.css('display','inline');ridQ.css('display','none');}
			else{rid.css('display','none');ridQ.css('display','inline');}
		});

	});
</script>
<p id="expT">Set an expiration date after<br>which the url will no longer<br>redirect.</p>
<p id="cusT">Customize your link<br>for example: <span style="color:blue">http://zipc.at/mycat</span></p>
<p id="pasT">Given URL will only redirect<br>if the correct password is<br>provided.</p>
<p id="urlT">Paste a long URL<br>you want to shorten.</p>
<p id="ridT">Add text to the password screen<br>for example: [password: <span style="color:blue">no</span>]<br>[question: <span style="color:blue">is the earth flat?</span>]</p>
