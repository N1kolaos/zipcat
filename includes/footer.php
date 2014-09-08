<br>
<div class="line">
<h4>ZipCat Stats!</h4>
<p><?php echo mysql_result(mysql_query("SELECT COUNT(url) FROM urls"),0,0);?> shortened urls<br>
Served <?php echo mysql_result(mysql_query("SELECT count FROM clicks"),0,0)?> times!</p>
</div>
</div>
</body>
</html>