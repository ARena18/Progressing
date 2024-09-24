<?php
  $servername = "cssql.seattleu.edu";
  $username = "bd_rahn";
  $password = "EYYCWXCR";
  $dbname = "bd_rahn";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $command = $_POST["action"];
  $sql = $command . " " . $_POST["query"];
  $result = mysqli_query($conn, $sql);

  if($command == "select") {
    echo "<h1 style='text-align: center'>Table Data</h1>\n";
    echo "<div style='display: flex; justify-content: center'>\n";

    if(mysqli_num_rows($result) > 0) {
      echo "<table border='1' style='border-collapse: collapse'>\n";

      $values = $result->fetch_assoc();
      $colNames = array_keys($values);
      echo "<tr>\n";
      $cols = mysqli_num_fields($result);
      for($i = 0; $i < $cols; $i++) {
        echo "<th>" . $colNames[$i] . "</th>\n";
      }
      echo "</tr>\n";

      mysqli_free_result($result);
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_row($result)) {
        echo "<tr>\n";
        for($i = 0; $i < $cols; $i++) {
          echo "<td>" . $row[$i] . "</td>\n";
        }
        echo "</tr>\n";
      }
      echo "</table>\n";
      echo "</div>\n";
    } else {
      echo "0 results";
    }
    mysqli_free_result($result);
  } else {
    if($result) {
      echo "Query successfully executed " . $command . "!";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
?>