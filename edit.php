<?php 
    include 'dbconnection.php';

    $errorMessage = "";
    $successMessage = "";
    
    $id = "";
    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET['id'])) {
            header('location: index.php');
            exit;
        }
        $id = $_GET['id'];

        $sql ="SELECT * FROM client WHERE id=$id";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); 
            $name = $row["name"];
            $email = $row["email"];
            $phone = $row["phone"];
            $address = $row["address"];
        } else {
            header("location: index.php");
            exit;
        }
    } else {
        $id = $_POST["id"];
        $name = $_POST["name"]; 
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        do {
            if (empty($name) || empty($email) || empty($phone) || empty($address)) {
                $errorMessage = "All fields are required";
                break;
            }
            $sql = "UPDATE client SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
            $result = $connection->query($sql);
            
            if (!$result) {
                $errorMessage = "Invalid Query: " . $connection->error;
                break;
            }
            $successMessage = "Client updated successfully!";

            header("location: index.php");
            exit;
        
        } while(false);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Edit Client</h1>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="edit.php" method="post"> 
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="row mb-3">
                <label for="name" class="col-sm-1 col-form-label">Name:</label>
                <div class="col-sm-11">
                    <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-1 col-form-label">Email:</label>
                <div class="col-sm-11">
                    <input class="form-control" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone" class="col-sm-1 col-form-label">Phone:</label>
                <div class="col-sm-11">
                    <input class="form-control" type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="address" class="col-sm-1 col-form-label">Address:</label>
                <div class="col-sm-11">
                    <input class="form-control" type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
                </div>
            </div>

            <?php if (!empty($successMessage)): ?>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $successMessage; ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-sm-6 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-6 d-grid">
                    <a class="btn btn-outline-danger" href="index.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
