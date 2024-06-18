<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>

    <!-- link of css boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" >

</head>
<body>
    <div class="container my-5">
        <h2>List Of Clients</h2>
        <br>
        <a class="btn btn-primary " href="create.php" role="button"> New Clients</a>
        <br>
        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Addres</th>
                    <th>Created At</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>
                <?php 
                    include 'dbconnection.php';
                    

                    $sql = "SELECT * FROM client";
                    $result = $connection->query($sql);

                    if(!$result){
                        die ("Invalid Quary :".$connection -> error );
                    }


                    $rownumber = 1;
                    while ($row = $result->fetch_assoc()){
                        echo "
                         <tr>
                            <td>" . htmlspecialchars($row['id']) .  "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['phone']) . "</td>
                            <td>" . htmlspecialchars($row['address']) . "</td>
                            <td>" . htmlspecialchars($row['created_at']) . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='edit.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=" . htmlspecialchars($row['id']) . "'>Delete</a>
                            </td>

                        </tr>";
                    }
                    $connection->close();

                ?>
            </tbody>

        </table>
        

    </div>
    

</body>
</html>