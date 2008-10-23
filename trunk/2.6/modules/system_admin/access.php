<?php session_start();
if (isset($_GET["order"])) {
    $order = @$_GET["order"];
}
if (isset($_GET["type"])) {
    $ordtype = @$_GET["type"];
}

if (isset($_POST["filter"])) {
    $filter = @$_POST["filter"];
}
if (isset($_POST["filter_field"])) {
    $filterfield = @$_POST["filter_field"];
}
$wholeonly = false;
if (isset($_POST["wholeonly"])) {
    $wholeonly = @$_POST["wholeonly"];
}

if (!isset($order) && isset($_SESSION["order"])) {
    $order = $_SESSION["order"];
}
if (!isset($ordtype) && isset($_SESSION["type"])) {
    $ordtype = $_SESSION["type"];
}
if (!isset($filter) && isset($_SESSION["filter"])) {
    $filter = $_SESSION["filter"];
}
if (!isset($filterfield) && isset($_SESSION["filter_field"])) {
    $filterfield = $_SESSION["filter_field"];
}

?>

<html>
<head>
<title>CARE2x - Logs manager</title>
<meta name="generator" http-equiv="content-type" content="text/html">
<style type="text/css">
body {
    background-color: #FFFFFF;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
}

.bd {
    background-color: #FFFFFF;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
}

.tbl {
    background-color: #DEE7DE;
}

a:link {
    color: #FF0000;
    font-family: Arial;
    font-size: 12px;
}

a:active {
    color: #0000FF;
    font-family: Arial;
    font-size: 12px;
}

a:visited {
    color: #800080;
    font-family: Arial;
    font-size: 12px;
}

.hr {
    background-color: #CEC6B5;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
}

a.hr:link {
    color: #000000;
    font-family: Arial;
    font-size: 12px;
}

a.hr:active {
    color: #000000;
    font-family: Arial;
    font-size: 12px;
}

a.hr:visited {
    color: #000000;
    font-family: Arial;
    font-size: 12px;
}

.dr {
    background-color: #DEE7DE;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
}

.sr {
    background-color: #FFFBF0;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
}
</style>
</head>
<body>
<table class="bd" width="100%">
<tr>
<td class="hr">
<h2>CARE2x log manager</h2>
</td>
</tr>
</table>
<table width="100%">
<tr>

<td width="5%"></td>
<td bgcolor="#e0e0e0"></td>
<td width="5%"></td>
<td width="80%" valign="top"><?php
$conn = connect();
$showrecs = 20;
$pagerange = 10;

$a = @$_GET["a"];
$recid = @$_GET["recid"];
$page = @$_GET["page"];
if (!isset($page)) {
    $page = 1;
}

switch ($a) {
case "view":
    viewrec($recid);
    break;
    default:
    select();
    break;
}

if (isset($order)) {
    $_SESSION["order"] = $order;
}
if (isset($ordtype)) {
    $_SESSION["type"] = $ordtype;
}
if (isset($filter)) {
    $_SESSION["filter"] = $filter;
}
if (isset($filterfield)) {
    $_SESSION["filter_field"] = $filterfield;
}
if (isset($wholeonly)) {
    $_SESSION["wholeonly"] = $wholeonly;
}

sqlite_close($conn);
?></td>
</tr>
</table>
<table class="bd" width="100%">
<tr>
<td class="hr">log manager/</td>
</tr>
</table>
</body>
</html>

<?php function select() {
    global $a;
    global $showrecs;
    global $page;
    global $filter;
    global $filterfield;
    global $wholeonly;
    global $order;
    global $ordtype;
    
    
    if ($a == "reset") {
        $filter = "";
        $filterfield = "";
        $wholeonly = "";
        $order = "";
        $ordtype = "";
    }
    
    $checkstr = "";
    if ($wholeonly) {
        $checkstr = " checked";
    }
    if ($ordtype == "asc") {
        $ordtypestr = "desc";
    } else {
        $ordtypestr = "asc";
    }
    $res = sql_select();
    $count = sql_getrecordcount();
    if ($count % $showrecs != 0) {
        $pagecount = intval($count / $showrecs) + 1;
    } else {
        $pagecount = intval($count / $showrecs);
    }
    $startrec = $showrecs * ($page - 1);
    if ($startrec < $count) {
        sqlite_seek($res, $startrec);
    }
    $reccount = min($showrecs * $page, $count);
    ?>
    <table class="bd" border="0" cellspacing="1" cellpadding="4">
    <tr>
    <td>Table: access</td>
    </tr>
    <tr>
    <td>Records shown <?php echo $startrec + 1 ?> - <?php echo $reccount ?>
    of <?php echo $count ?></td>
    </tr>
    </table>
    <hr size="1" noshade>
    <form action="access.php" method="post">
    <table class="bd" border="0" cellspacing="1" cellpadding="4">
    <tr>
    <td><b>Custom Filter</b>&nbsp;
    </td>
    <td><input type="text" name="filter" value="<?php echo $filter ?>"></td>
    <td><select name="filter_field">
    <option value="">All Fields</option>
    <option value="<?php echo "ID" ?>"
    <?php if ($filterfield == "ID") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("ID") ?></option>
    <option value="<?php echo "DATETIME" ?>"
    <?php if ($filterfield == "DATETIME") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("DATETIME") ?></option>
    <option value="<?php echo "IP" ?>"
    <?php if ($filterfield == "IP") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("IP") ?></option>
    <option value="<?php echo "LOGNOTE" ?>"
    <?php if ($filterfield == "LOGNOTE") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("LOGNOTE") ?></option>
    <option value="<?php echo "USERID" ?>"
    <?php if ($filterfield == "USERID") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("USERID") ?></option>
    <option value="<?php echo "USERNAME" ?>"
    <?php if ($filterfield == "USERNAME") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("USERNAME") ?></option>
    <option value="<?php echo "PASSWORD" ?>"
    <?php if ($filterfield == "PASSWORD") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("PASSWORD") ?></option>
    <option value="<?php echo "THISFILE" ?>"
    <?php if ($filterfield == "THISFILE") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("THISFILE") ?></option>
    <option value="<?php echo "FILEFORWARD" ?>"
    <?php if ($filterfield == "FILEFORWARD") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("FILEFORWARD") ?></option>
    <option value="<?php echo "LOGIN_SUCCESS" ?>"
    <?php if ($filterfield == "LOGIN_SUCCESS") {
        echo "selected";
    }
    ?>><?php echo htmlspecialchars("LOGIN_SUCCESS") ?></option>
    </select></td>
    <td><input type="checkbox" name="wholeonly" <?php echo $checkstr ?>>Whole
    words only</td>
    </td>
    </tr>
    <tr>
    <td>&nbsp;
    </td>
    <td><input type="submit" name="action" value="Apply Filter"></td>
    <td><a href="access.php?a=reset">Reset Filter</a></td>
    </tr>
    </table>
    </form>
    <hr size="1" noshade>
    <?php showpagenav($page, $pagecount);
    ?>
    <br>
    <table class="tbl" border="0" cellspacing="1" cellpadding="5"
    width="100%">
    <tr>
    <td class="hr">&nbsp;
    </td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "ID" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("ID") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "DATETIME" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("DATETIME") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "IP" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("IP") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "LOGNOTE" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("LOGNOTE") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "USERID" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("USERID") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "USERNAME" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("USERNAME") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "PASSWORD" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("PASSWORD") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "THISFILE" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("THISFILE") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "FILEFORWARD" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("FILEFORWARD") ?></a></td>
    <td class="hr"><a class="hr"
    href="access.php?order=<?php echo "LOGIN_SUCCESS" ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars("LOGIN_SUCCESS") ?></a></td>
    </tr>
    <?php
    for ($i = $startrec; $i < $reccount; $i++) {
        $row = sqlite_fetch_array_ex($res);
        $style = "dr";
        if ($i % 2 != 0) {
            $style = "sr";
        }
        ?>
        <tr>
        <td class="<?php echo $style ?>"><a
        href="access.php?a=view&recid=<?php echo $i ?>">View</a></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["ID"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["DATETIME"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["IP"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["LOGNOTE"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["USERID"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["USERNAME"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["PASSWORD"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["THISFILE"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["FILEFORWARD"]) ?></td>
        <td class="<?php echo $style ?>"><?php echo htmlspecialchars($row["LOGIN_SUCCESS"]) ?></td>
        </tr>
        <?php
    }
    // sqlite_free_result($res);
    ?>
    </table>
    <br>
    <?php showpagenav($page, $pagecount);
    ?>
<?php }
?>

<?php function showrow($row, $recid) {
    ?>
    <table class="tbl" border="0" cellspacing="1" cellpadding="5"
    width="50%">
    <tr>
    <td class="hr"><?php echo htmlspecialchars("ID")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["ID"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("DATETIME")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["DATETIME"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("IP")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["IP"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("LOGNOTE")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["LOGNOTE"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("USERID")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["USERID"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("USERNAME")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["USERNAME"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("PASSWORD")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["PASSWORD"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("THISFILE")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["THISFILE"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("FILEFORWARD")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["FILEFORWARD"]) ?></td>
    </tr>
    <tr>
    <td class="hr"><?php echo htmlspecialchars("LOGIN_SUCCESS")."&nbsp;" ?></td>
    <td class="dr"><?php echo htmlspecialchars($row["LOGIN_SUCCESS"]) ?></td>
    </tr>
    </table>
<?php }
?>

<?php function showpagenav($page, $pagecount) {
    ?>
    <table class="bd" border="0" cellspacing="1" cellpadding="4">
    <tr>
    <?php if ($page > 1) {
        ?>
        <td><a href="access.php?page=<?php echo $page - 1 ?>">&lt;
        &lt;
        &nbsp;
        Prev</a>&nbsp;
        </td>
    <?php }
    ?>
    <?php
    global $pagerange;
    
    if ($pagecount > 1) {
        
        if ($pagecount % $pagerange != 0) {
            $rangecount = intval($pagecount / $pagerange) + 1;
        } else {
            $rangecount = intval($pagecount / $pagerange);
        }
        for ($i = 1; $i < $rangecount + 1; $i++) {
            $startpage = (($i - 1) * $pagerange) + 1;
            $count = min($i * $pagerange, $pagecount);
            
            if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
                for ($j = $startpage; $j < $count + 1; $j++) {
                    if ($j == $page) {
                        ?>
                        <td><b><?php echo $j ?></b></td>
                    <?php } else {
                        ?>
                        <td><a href="access.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
                    <?php }
                }
            } else {
                ?>
                <td><a href="access.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a></td>
            <?php }
        }
    }
    ?>
    <?php if ($page < $pagecount) {
        ?>
        <td>&nbsp;
        <a href="access.php?page=<?php echo $page + 1 ?>">Next&nbsp;
        &gt;
        &gt;
        </a>&nbsp;
        </td>
    <?php }
    ?>
    </tr>
    </table>
<?php }
?>

<?php
function showrecnav($a, $recid, $count) {
    ?>
    <table class="bd" border="0" cellspacing="1" cellpadding="4">
    <tr>
    <td><a href="access.php">Index Page</a></td>
    <?php if ($recid > 0) {
        ?>
        <td><a href="access.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Prior Record</a></td>
    <?php }
    if ($recid < $count - 1) {
        ?>
        <td><a href="access.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Next Record</a></td>
    <?php }
    ?>
    </tr>
    </table>
    <hr size="1" noshade>
<?php }
?>


<?php function viewrec($recid) 	{
    $res = sql_select();
    $count = sql_getrecordcount();
    sqlite_seek($res, $recid);
    $row = sqlite_fetch_array_ex($res);
    showrecnav("view", $recid, $count);
    ?>
    <br>
    <?php showrow($row, $recid) ?>
    <?php
    // sqlite_free_result($res);
}
?>

<?php
function connect() {
    $conn = sqlite_open("../../logs/logs.sqlite");
    return $conn;
}

function sqlstr($val)
{
    return str_replace("'", "''", $val);
}

function sql_select() {
    global $conn;
    global $order;
    global $ordtype;
    global $filter;
    global $filterfield;
    global $wholeonly;
    
    $filterstr = sqlstr($filter);
    if (!$wholeonly && isset($wholeonly) && $filterstr!='') {
        $filterstr = "%" .$filterstr ."%";
    }
    $sql = "SELECT ID, DATETIME, IP, LOGNOTE, USERID, USERNAME, PASSWORD, THISFILE, FILEFORWARD, LOGIN_SUCCESS FROM access";
    if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
        $sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
    } else if (isset($filterstr) && $filterstr!='') {
        $sql .= " where (ID like '" .$filterstr ."') or (DATETIME like '" .$filterstr ."') or (IP like '" .$filterstr ."') or (LOGNOTE like '" .$filterstr ."') or (USERID like '" .$filterstr ."') or (USERNAME like '" .$filterstr ."') or (PASSWORD like '" .$filterstr ."') or (THISFILE like '" .$filterstr ."') or (FILEFORWARD like '" .$filterstr ."') or (LOGIN_SUCCESS like '" .$filterstr ."')";
    }
    if (isset($order) && $order!='') {
        $sql .= " order by \"" .sqlstr($order) ."\"";
    }
    if (isset($ordtype) && $ordtype!='') {
        $sql .= " " .sqlstr($ordtype);
    }
    $res = sqlite_query($conn, $sql) or die(sqlite_error_string());
    return $res;
}

function sql_getrecordcount() {
    global $conn;
    global $order;
    global $ordtype;
    global $filter;
    global $filterfield;
    global $wholeonly;
    
    $filterstr = sqlstr($filter);
    if (!$wholeonly && isset($wholeonly) && $filterstr!='') {
        $filterstr = "%" .$filterstr ."%";
    }
    $sql = "SELECT COUNT(*) FROM access";
    if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
        $sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
    } else if (isset($filterstr) && $filterstr!='') {
        $sql .= " where (ID like '" .$filterstr ."') or (DATETIME like '" .$filterstr ."') or (IP like '" .$filterstr ."') or (LOGNOTE like '" .$filterstr ."') or (USERID like '" .$filterstr ."') or (USERNAME like '" .$filterstr ."') or (PASSWORD like '" .$filterstr ."') or (THISFILE like '" .$filterstr ."') or (FILEFORWARD like '" .$filterstr ."') or (LOGIN_SUCCESS like '" .$filterstr ."')";
    }
    $res = sqlite_query($conn, $sql) or die(sqlite_error_string());
    $row = sqlite_fetch_array_ex($res);
    reset($row);
    return current($row);
}

function sqlite_fetch_array_ex($res) {
    
    if (!($tmprow = sqlite_fetch_array($res, SQLITE_ASSOC)))
    return false;
    $resrow = array();
    foreach($tmprow as $key=>$value) {
        $key=preg_replace('/^"(.+)"$/','',$key);
        $resrow[$key]=$value;
    }
    
    return $resrow;
}
?>
