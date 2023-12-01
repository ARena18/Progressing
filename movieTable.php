<?php
  $servername = "cssql.seattleu.edu";
  $username = "bd_rahn";
  $password = "EYYCWXCR";
  $dbname = "bd_rahn";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM MOVIE";
  $result = mysqli_query($conn, $sql);

  echo "<h1 style='text-align: center'>Movie Table</h1>\n";
  echo "<div style='display: flex; justify-content: center'>\n";

  if(mysqli_num_rows($result) > 0) {
    echo "<table border='1' style='border-collapse: collapse'>\n";
    echo "<tr>\n";
    echo "<th>Movie ID</th>\n";
    echo "<th>Direcor ID</th>\n";
    echo "<th>Main Actor ID</th>\n";
    echo "<th>Title</th>\n";
    echo "<th>Genre</th>\n";
    echo "<th>Run Time (minutes)</th>\n";
    echo "<th>Year Released</th>\n";
    echo "</tr>\n";
    while($row = mysqli_fetch_row($result)) {
      echo "<tr>\n";
      $cols = mysqli_num_fields($result);
      for($i = 0; $i < $cols; $i++) {
        echo "<td>$row[$i]</td>\n";
      }
      echo "</tr>\n";
    }
    echo "</table>\n";
  } else {
    echo "0 results";
  }
  echo "</div>\n";

  mysqli_free_result($result);
  mysqli_close($conn);      
?>