  <!-- Begin #sidebar1 -->
  <?php if (isset($message)) { ?>
  <div id="msgbar1">
  <p style="padding-left:10px">
  <?php echo $message; ?>
  </p>
  </div>
  <?php } ?>
  
  <div id="sidebar1">
    <form name="login" id="login" action="viewsnips.php" method="post">
    <center>
    <?php if ( isset($_SESSION['loggedin']) ) {
			echo $_SESSION['user'] . "  ";
			echo "<a href='#' onclick='document.login.submit()'><img src='/lovesnips/image/connect.png'/></a>";
			echo "<input type='hidden' name='user' value='username' />";
			echo "<input type='hidden' name='pass' value='pass' />";
		} else {
	?>
    <input type="text" name="user" value="username" size="7" onfocus="clearForm(this);"/> 
    <input type="password" name="pass" value="1111111" size="7" onfocus="clearForm(this);"/>
    <a href='#' onclick='document.login.submit()'><img src='/lovesnips/image/disconnect.png'/></a>
    <br><a href="/lovesnips/register.php">Register</a>
	<?php
			}
	?>
    </center>
    </form>
    <?php if ( isset($_SESSION['loggedin']) ) { ?>
    <p style="margin-top:5px">
    <a href="/lovesnips/addsnip.php"><img src="/lovesnips/image/application_edit.png" />Add Snip</a><br>
    <a href="/lovesnips/editsnips.php"><img src="/lovesnips/image/application_key.png" />Edit Snips</a><br>
	<a href="/lovesnips/"><img src="/lovesnips/image/new.png" />Latest Snips</a>
    </p>
    <?php } ?>
    <h3>Catagories:</h3>
    <p><?php
		while ( $row_catagories = mysql_fetch_assoc($catagories) ) {
			if ($row_catagories['snips'] > 0) {
				$thiscat = $row_catagories['catagory'];
				echo "<a href=\"/lovesnips/cat/$thiscat\" >";
				echo $thiscat . " (" . $row_catagories['snips'] . ")<br></a>";
			}
		}
	?></p>
    </div>
  <!-- end #sidebar1 -->
