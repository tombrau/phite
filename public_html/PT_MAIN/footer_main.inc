<?php include_once('tools/counter/statistics.php'); ?>
<table border=0 cellspacing="0" cellpadding="0">
  <tr bgcolor="#006699">
    <td width="229" height="45" align="center">
      <span>
        <font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">
        Chris Robson 2002, Tom Brennfleck 2009
        </font>
      </span>
    </td>
    <td width="363">
    <span>
      <center>
      <font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">
        <a href="popups/privacy_policy.html" 
          onclick="return popup(this,'question')" style="color: #FFFFFF;">Privacy</a>         
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="popups/disclaimer.html" 
          onclick="return popup(this,'question')" style="color: #FFFFFF;">Disclaimer</a>
        </font>
      </center>
    </span>
    </td>
    <td width="256" >
      <div align="center">
	<span >
	<font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">
    Online: <?php echo $online; ?> &nbsp;&nbsp;
	  Today: <?php echo $today; ?> &nbsp;&nbsp;
	  Total: <?php echo $total; ?> <br>
    <a target='_blank' href='http://www.phite.org.au' style="color: #FFFFFF;">Powered by Phite</a>
    </font>
  </span>
      </div>
    </td>
  </tr>
</table>
