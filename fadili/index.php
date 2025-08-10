<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
require_once 'process.php'; 

if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?= $_SESSION['msg_type'] ?>">
    <?= $_SESSION['message']; ?>
    <?php unset($_SESSION['message']); ?>
</div>
<?php endif; ?>

<div class="container">
<?php
$mysqli = new mysqli('localhost', 'root', '', 'CRUD') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
?>

<div class="row justify-content-center">
<table class="table">
<thead>
<tr>
   <th>Name</th>
   <th>Location</th>
   <th colspan="2">Action</th>
</tr>
</thead>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['name']; ?></td>
    <td><?= $row['location']; ?></td>
    <td>
       <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>

        <a href="process.php?delete=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</div>

<div class="row justify-content-center">
<form action="" method="POST">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $name; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Location:</label>
        <input type="text" name="location" value="<?= $location; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <?php if ($update): ?>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
        <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>
    </div>
</form>
</div>
</div>

</body>
</html>
