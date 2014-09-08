<form action="./gateway.php" method="post">
<h3>URL is password-protected</h3>
<?php if($riddle!==NULL)echo "<div id=\"riddle\"><h4><u>Help Text</u></h4>\n$riddle</div>";?>
<p>Please insert password:<br><input type="password" name="password"><input type="submit" value="GO"></p>
<input type="hidden" name="code" value="<?php echo $code_; ?>">
</form>
<p style="color:orange;">Protected URL served <?php echo $clicks ?> times.</p>