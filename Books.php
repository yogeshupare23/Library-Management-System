<?php
	 require ('admin/db_connect.php');
     function getAllBooks($connection) {
        // Query to fetch all student records
        $query = "SELECT * FROM books";
        $result = mysqli_query($connection, $query);
    
        // Check if query executed successfully
        if ($result) {
            // Fetch all student records into an associative array
            $book = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
            // Encode the array into JSON format
            $json_data = json_encode($book );
    
            return $json_data;
        } else {
            // Error handling if query fails
            return "Error: " . mysqli_error($connection);
        }
    }
    
    
     function addBook( $connection,$book_name, $book_author,$book_cat, $book_no,$book_price) {
        // $query = "insert into books values(null,'$book_name','$book_author','$book_cat',$book_no,$book_price)";
		// $query_run = mysqli_query($connection,$query);
        // Sanitize inputs to prevent SQL injection
        $book_name = mysqli_real_escape_string($connection, $book_name);
        $book_author = mysqli_real_escape_string($connection, $book_author);
        $book_cat = mysqli_real_escape_string($connection, $book_cat);
        $book_no = intval($book_no); // Convert age to integer
        $book_price = intval( $book_price);
    
        // Query to insert student record into the student_data table
        $query = "INSERT INTO books VALUES (null,'$book_name','$book_author', '$book_cat',$book_no,$book_price)";
        
        // Execute the query
        if (mysqli_query($connection, $query)) {
            return true; // Record added successfully
        } else {
            // Error handling if query fails
            return "Error: " . mysqli_error($connection);
        }
    }

  $booksData =  getAllBooks($connection);
  echo $booksData;
$book_name = "Java Programming";
$book_author = "John Deo";
$book_cat = "Programming Languages";
$book_no = 123;
$book_price = 1549;
//$result = addBook($connection,$book_name, $book_author,$book_cat, $book_no,$book_price);

// Check result of adding the student record
// if ($booksData === true) {
//     echo "Book record added successfully!";
// } else {
//     echo $result; // Display error message
// }

// Close database connection
mysqli_close($connection);
	//$query_run = mysqli_query($connection,$query);
?>