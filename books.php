<?php
session_start();
include 'db.php';

// Admin emails
$admin_emails = ['ravitej7133@gmail.com', 'loukickreddy097@gmail.com'];

// Fetch all uploaded books
$sql = "SELECT * FROM books ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Library Books</title>
  <link rel="stylesheet" href="style.css">
  
  
</head>
<body>

<header>
  <h1>📚 Library Books</h1>
  <nav>
    <?php 
    if(isset($_SESSION['email']) && in_array($_SESSION['email'], $admin_emails)){ 
    ?>
      <a href="add_book.php">Add Book</a>
    <?php } ?>
    
  </nav>
</header>

<table>
  <tr>
    <th>ID</th>
    <th>Title</th>
    <th>Author</th>
    <th>Year</th>
    <th>View / Download</th>
  </tr>

  <?php
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $file_url = htmlspecialchars($row['file_path'], ENT_QUOTES);
    
      echo "<tr>";
      echo "<td>{$row['id']}</td>";
      echo "<td>{$row['title']}</td>";
      echo "<td>{$row['author']}</td>";
      echo "<td>{$row['year']}</td>";
      echo "<td><a href='$file_url' target='_blank'>📖 View PDF</a></td>";
      echo "</tr>";
      
    }
  } else {
    echo "<tr><td colspan='5'>No PDFs found.</td></tr>";
  }
  ?>
</table>

</body>
</html>
