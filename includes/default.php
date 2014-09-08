<h3>Shorten and password protect URL!</h3>
<form action='./shorten.php' method="post">
	<input type="url" name="new_url" placeholder="paste URL ." size="30"><div id="urlQ">(?)</div><br>
	<input type="text" name="password" placeholder="type password ." size="30"><div id="pasQ">(?)</div>
	<br><input type="submit" value="Submit"><br>
	<div class="line">
	<h4>Optional options</h4>
	<ul>
		<li><input type="checkbox" name="custom"> customize <div id="cusQ">(?)</div><span id="cus">link:<br>http://zipc.at/<input type="text" class="left" name="custom_code" size="10" maxsize="32" placeholder="mycat"></span></li>
		<li><input type="checkbox" name="expiration"> expires <div id="expQ">(?)</div><span id="exp">in <input type="text" name="expiration_value" maxlength="7" size="5" placeholder="30"> days.</span></li>
		<li><input type="checkbox" name="riddle"> riddle/helptext <div id="ridQ">(?)</div><span id="rid"><br><textarea name="riddle_text" placeholder="Type the text here." maxlength="200"></textarea></span></li>
	</ul>
	</div>
</form>
