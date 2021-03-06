<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="content-type" content="text/html;charset=<?php echo SYL_ENCODE_INTERNAL; ?>" />
<meta http-equiv="content-style-type" content="text/css" />
<title>SyL error</title>
<style type="text/css">
<!--

* {
  margin:  0px;
  padding: 0px;
}

body {
  color: #003366;
  background-color: #C0CEEB;
  font-size: medium;
}

#error-header-container {
  color: #FFFFFF;
  padding: 6px 20px;
  background-color: #597fc8;
  border-bottom: 2px solid #59709D;
  height: 36px;
}

#error-message-container {
}

#error-environment-container {
}

#error-source-container {
}

#error-trace-container {
}

#error-footer-container {
  padding: 6px 10px;
}


#error-source-container pre {
  font-size: 78%;
  padding: 10px;
  margin-bottom: 10px;
  background-color: #EEEEEE;
}

#error-trace-container table {
  padding: 0px;
  margin:  0px;
  font-size: 82%;
  width: 100%;
}

#error-trace-container table th,
#error-trace-container table td {
  padding: 5px;
}

#error-trace-container table th {
  text-align: left;
  background: #E6E8F2;
}

#error-trace-container table tr.bg0 {
  background-color: #FFFFFF;
}

#error-trace-container table tr.bg1 {
  background-color: #f7f7f7;
}

#error-environment-container table {
  padding: 0px;
  margin:  0px;
  font-size: 78%;
  width: 100%;
  margin-bottom: 6px;
}

#error-environment-container table th,
#error-environment-container table td {
  padding: 5px;
}

#error-environment-container table th {
  text-align: right;
  white-space: nowrap;
  background-color: #E6E8F2;
}

#error-environment-container table td {
  width: 100%;
}

#error-footer-container div {
  font-size: 82%;
}

fieldset {
  padding: 0 15px 15px 15px;
}

legend {
  color:#333333;
  font-weight: bold;
  padding: 2px 10px;
  margin-bottom: 15px;
  border-style: solid;
  border-width: 1px;
  border-color: #EEEEEE #999999 #999999 #EEEEEE;
  background-color: #E6E8F2;
} 

.error-container {
  background-color: #FFFFFF;
  padding:10px;
  margin: 10px;
} 

h1 {
  font-style: italic;
}

h3 {
  color: #CC0000;
}

--> 
</style>

</head>

<body>

<div id="error-header-container">
  <h1>Internal Server <span style="color: #FFAAAA">E</span>rror on SyL Framework</h1>
</div> 

<div id="error-message-container" class="error-container">
  <fieldset>
    <legend>Error Message</legend> 
    <h3><?php echo $_error_message; ?></h3> 
  </fieldset> 
</div>

<?php if ($_error_lines) { ?>
<div id="error-source-container" class="error-container">
  <fieldset>
    <legend>Error Source</legend> 
    <div>
<?php
$keys  = array();
$first = true;
foreach ($_error_lines as $key => $values) {
    $display = '';
    if ($first) {
        $display = 'block';
        $first   = false;
    } else {
        $display = 'none';
    }
?>
    <pre id="file<?php echo $key ?>" style="display: <?php echo $display; ?>;"><?php echo $values; ?></pre>
<?php } ?>
<script type="text/javascript">
<!--
var source_ids = [];

document.write("|&nbsp;&nbsp;");
<?php
foreach ($_error_lines as $key => $values) {
    if ($values) {
        echo 'document.write(\'<a href="javascript: void(0);" onClick="display_source(\\\'file' . $key . '\\\')">file' . $key . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;\');' . "\n";
    } else {
        echo 'document.write(\'file' . $key . '&nbsp;&nbsp;|&nbsp;&nbsp;\');' . "\n";
    }
    echo 'source_ids.push("file' . $key . '");' . "\n";
}
?>
if (source_ids[0]) {
  document.getElementById(source_ids[0]).style.display = 'block';
}
document.write("<br><br>");

function display_source(id)
{
  for (var i=0; i<source_ids.length; i++) {
    document.getElementById(source_ids[i]).style.display = 'none';
  }
  document.getElementById(id).style.display = 'block';
}

-->
</script>
    </div>
  </fieldset>
</div>
<?php } ?>

<?php if ($_error_trace) { ?>
<div id="error-trace-container" class="error-container">
  <fieldset>
    <legend>Error Trace</legend> 
    <table>
      <tr>
        <th>#</th>
        <th>file</th>
        <th>line</th>
        <th>function or method</th>
      </tr>
<?php foreach ($_error_trace as $i => $values) { ?>
      <tr class="bg<?php echo $i%2; ?>">
        <td><?php echo $values['no']; ?></td>
        <td><?php echo $values['file']; ?></td>
        <td align="right"><?php echo $values['line']; ?></td>
        <td><?php echo $values['function']; ?></td>
      </tr>
<?php } ?>
    </table>
  </fieldset> 
</div>
<?php } ?>

<?php if (SYL_ERROR) { ?>
<div id="error-environment-container" class="error-container"> 
  <fieldset>
    <legend>Error Environment</legend> 
    <table>
      <tr>
        <th>PHP_VERSION</th>
        <td><?php echo PHP_VERSION; ?></td>
      </tr>
    </table>

    <table>
      <tr>
        <th>GET</th>
        <td><?php echo htmlspecialchars(var_export($_GET, true)); ?></td>
      </tr> 
      <tr>
        <th>POST</th>
        <td><?php echo htmlspecialchars(var_export($_POST, true)); ?></td>
      </tr> 
      <tr>
        <th>COOKIE</th>
        <td><?php echo htmlspecialchars(var_export($_COOKIE, true)); ?></td>
      </tr> 
    </table> 

    <table>
      <?php foreach ($_SERVER as $name => $value) { ?>
      <tr>
        <th><?php echo $name; ?></th>
        <td><?php echo htmlspecialchars(var_export($value, true)); ?></td>
      </tr> 
      <?php } ?>
    </table> 

    <table>
      <tr>
        <th>SYL_VERSION</th>
        <td><?php echo SYL_VERSION; ?></td>
      </tr> 
      <tr>
        <th>SYL_PROJECT_DIR</th>
        <td><?php echo SYL_PROJECT_DIR; ?></td>
      </tr> 
      <tr>
        <th>SYL_APP_DIR</th>
        <td><?php echo SYL_APP_DIR; ?></td>
      </tr> 
      <tr>
        <th>SYL_ACTION_KEY</th>
        <td><?php echo SYL_ACTION_KEY; ?></td>
      </tr> 
      <tr>
        <th>SYL_ENCODE_INTERNAL</th>
        <td><?php echo SYL_ENCODE_INTERNAL; ?></td>
      </tr> 
      <tr>
        <th>SYL_LOG</th>
        <td><?php echo SYL_LOG; ?></td>
      </tr> 
    </table> 
  </fieldset> 
</div> 
<?php } ?>

<?php if (SYL_ERROR) { ?>
<div id="error-footer-container">
  <div>Date: <?php echo date('Y-m-d H:i:s'); ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo php_uname(); ?></div>
</div> 
<?php } ?>

</body>
</html>
