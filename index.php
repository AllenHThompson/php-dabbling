<?php

<?php
--
-- Database: `excel`
--

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `name` text NOT NULL,
  `age` text NOT NULL,
  `work` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`name`, `age`, `work`, `status`) VALUES
('Aneh Thakur', '22', 'Android & PHP', 'Love think Code!!'),
('Amit Rana', '22', 'PHP & Iphone', 'Happy'),
('Mandeep', '23', 'PHP', ''),
('Lucky', '23', 'RJ', 'Sanjh Radio');


// Connection
$con = mysql_connect("localhost", "root", "");
$db = mysql_select_db("excel", $con);



include_once('conn.php');
$fo = fopen('file.csv', "r"); // CSV fiile
while (($emapData = fgetcsv($fo, "", ",")) !== FALSE)
{
      $sql = "INSERT into info (name,age,work,status) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]')";
      mysql_query($sql);
}


// Connection
include_once('conn.php');

$sql = "select * from info";
$qur = mysql_query($sql);

// Enable to download this file
$filename = "sampledata.csv";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv");

$display = fopen("php://output", 'w');

$flag = false;
while($row = mysql_fetch_assoc($qur)) {
    if(!$flag) {
      // display field/column names as first row
      fputcsv($display, array_keys($row), ",", '"');
      $flag = true;
    }
    fputcsv($display, array_values($row), ",", '"');
  }

fclose($display);

// Connection
include_once('conn.php');

$filename = "sampledata.xls"; // File Name

// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

// Write data to file
$flag = false;
while($row = mysql_fetch_assoc($qur)) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
  }
?>



//{
//	$filename = "/test.xlsx";
//	echo $filename;
//}

//include_once('conn.php');
$fo = fopen('data/source/order-items.csv', "r"); // CSV fiile
while (($emapData = fgetcsv($fo, "", ",")) !== FALSE)
{
      $sql = "INSERT into info (name,age,work,status) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]')";
      mysql_query($sql);
}




?>



<!DOCTYPE html>
<html>
     <head>
          <meta charset="utf-8">
          <title></title>
     </head>
     <body>

          <form action="index.php" method="post">
               <button type="submit" name="submit"></button>
          </form>

     </body>
</html>
