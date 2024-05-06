<?php
session_start(); 

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

include('logic/dbCon.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Dashboard</title>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  
    <style>
       body {
  font-family: Arial, sans-serif;
  background-color: #2b5b4d;
  margin: 0;
  padding: 20px;
  }
header {
background-color: #4CAF50;
padding: 10px;
}

ul {
list-style-type: none;
margin: 0;
padding: 0;
display: flex;
justify-content: space-between;
align-items: center;
}

li {
border:1px solid #000;
margin-right: 15px;
}

p {
margin: 0;
color: #fff;
}

h1 {
color: #fff; 
text-align: center;
font-family: Arial, sans-serif;
font-weight: bold;
font-size: 28px;
text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}
th, td {
  color: #fff; 
padding: 10px;
text-align: left;
border: 2px solid #fff; 
}
th {
background-color: #1e7e34; 
color: #ffffff; 
}
tr:nth-child(even) {
background-color: #15a762; 
}
.btn {
text-align: right;
margin-top: 20px;
}

.btn button {
background-color: #4CAF50;
border: none;
color: white;
padding: 12px 24px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin: 4px 2px;
cursor: pointer;
border-radius: 8px;
box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.btn button:hover {
background-color: #45a049;
}

.btn button:active {
background-color: #156d3c; 
} 
    </style>
</head>
<body>
    <header>
    <ul>
        <li>
             <form action=" logic/logout_script.php" method="post">
                <button type="submit">Log-Out</button>
            </form>
        </li>
        <li>
             <p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
        </li>
        <li>
             <p>Email: <?php echo $_SESSION['email']; ?></p>
        </li>
    </ul>
   

    </header>
   
    <h1>Dashboard</h1>
    
  
   
  
    <div class="btn">
    <form action="addUser.php" method="get">
        <button type="submit">Add User</button>
    </form>
    </div>
   


  

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Access  </th>
                <th>Actions</th> 
            </tr>
        </thead>
        <tbody>
            <?php
           
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['code']."</td>";
                    echo "<td>".$row['fname']."</td>";
                    echo "<td>".$row['lname']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['status']."</td>";
                    $user_access_sql = "SELECT access FROM user_access WHERE code = " . $row['code'];
                    $user_access_result = mysqli_query($conn, $user_access_sql);
                    $access_array = [];
                    while ($access_row = mysqli_fetch_assoc($user_access_result)) {
                        $access_array[] = $access_row['access'];
                    }
                    
                    $access_string = implode(", ", $access_array);
                    echo "<td>".$access_string."</td>";
                    echo "<td>
                    <a href='update.php?code=".$row['code']."'><i class='fas fa-edit' style='font-size:30px;color:#000; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);'></i> <span class='sr-only'>Update</span></a> |
                    <a href='deleteUser.php?code=".$row['code']."'> <i class='fa fa-trash' style='font-size:30px;color:#000; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);'></i> <span class='sr-only'>Delete</span></a>
                </td>";
                
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found.</td></tr>"; 
            }
            
            ?>
        </tbody>
    </table>
  
</body>
</html>
