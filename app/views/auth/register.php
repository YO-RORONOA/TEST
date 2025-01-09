<?php include __DIR__.'/../layouts/header.php'; ?>
<?php
require_once __DIR__.'/../../config/Database.php';








class Register
{

    protected $db;
    protected $id;
    protected $username;
    protected $fullname;
    protected $password;
    protected $created_at;
    protected $hashedPassword;


    public function __construct($db)
    {
        $this->db = $db;
    }



    public function validatedregister()
    {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $this->username = trim($_POST['username']);
    $this->fullname = trim($_POST['fullname']);
    $this->password = trim($_POST['password']);

    try {

        // Check if username already exists
        $query = "SELECT COUNT(*) FROM User WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Username already exists
            $_SESSION['error'] = "Username already exists. Please choose another one.";
            header("Location: ../../views/auth/register.php");
            exit();
        }

        // Hash the password
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }
}
    }


        public function adduser($username, $fullname, $hashedPassword)
        {
        // Insert user into the database
        $query = "INSERT INTO User (username, fullname, password) VALUES (:username, :fullname, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':fullname', $this->fullname);
        $stmt->bindParam(':password', $this->hashedPassword);

        $stmt->execute();

        // Registration successful
        $_SESSION['success'] = "Registration successful! Please log in.";
        header("Location: ../../views/auth/login.php");
        exit();
        catch (PDOException $e)
     {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }

else 
{
    // Redirect if accessed without form submission
    header("Location: ../../views/auth/register.php");
    exit();
}
}
    







}










?>
<h2>Register</h2>
<!-- TODO: Add registration form with input fields for username, password, etc. -->
<!-- Add Bootstrap form classes as needed -->
<form method="post" action="../../controllers/auth/register.php">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>
    <div class="form-group">
        <label for="fullname">Fullname:</label>
        <input type="text" class="form-control" name="fullname" id="fullname" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <!-- Add other registration fields as needed -->
    <button type="submit" class="btn btn-success">Register</button>
</form>

<?php include __DIR__.'/../layouts/footer.php'; ?>





