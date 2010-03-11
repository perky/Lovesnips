<form action="<?php echo $editFormAction; ?>" method="post" name="addsnip" id="addsnip">
  <table align="center">
    <tr valign="baseline">
      <td><div align="center">
        <input type="text" id="title" name="title" value="<?php echo $form['title']?>" size="32" onfocus="clearForm(this);"/>
        <select name="catagory" id="catagory">
          <?php 
do {  
?>
          <option value="<?php echo $row_Catagories['catagory']?>" 
		  <?php if (strcmp($row_Catagories['catagory'],$form['catagory']) == 0)
		  			echo "selected='selected'";
		  ?> ><?php echo $row_Catagories['catagory']?></option>
          <?php
} while ($row_Catagories = mysql_fetch_assoc($Catagories));
?>
        </select>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td height="126"><div align="center">
        <textarea name="code" id="code" cols="50" rows="10" onfocus="clearForm(this);"><?php echo $form['code']?></textarea>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td><div align="center">
        <textarea name="description" id="desc" cols="50" rows="5" onfocus="clearForm(this);"><?php echo $form['desc']?></textarea>
      </div></td>
    </tr>
    <tr valign="baseline">
    	<td><div align="center">
        <input type="text" name="user" id="user" value="<?php echo $form['user']?>" size="22" onfocus="clearForm(this);" />
        <input type="password" name="pass" id="pass" value="<?php echo $form['pass']?>" size="22"  onfocus="clearForm(this);" />
      </div></td>
    </tr>
    <tr valign="baseline">
      <td><div align="center">
        <input type="submit" value="Snip Me!" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="addsnip" />
  <input type="hidden" name="snip_id" value="<?php echo $form['id']; ?>" />
  <input type="hidden" name="snip_cat" value="<?php echo $form['catagory']; ?>" />
</form>