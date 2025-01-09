<?php include __DIR__.'/../layouts/header.php';?>

<?php 
require_once __DIR__.'/../../config/Database.php';







class Login
{

    protected $db;
    // protected $id;
    protected $username;
    protected $password;
    protected $user;


    public function __construct($db)
    {
        $this->db = $db;
    }



    public function loginvalidation()
    {
        // Check if form data is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->username = $_POST['username'];
            $this->password = $_POST['password'];

            // Query to check if the user exists
            $query = "SELECT * FROM User WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();

            $this->user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }



        public function verifypassword()
        {
        // Verify user credentials
        if ($this->user && password_verify($this->password, $this->user['password'])) {
            // Store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to a protected page
            header("Location: ../../views/dashboard.php");
            exit();
        } else {
            // Invalid credentials
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ../../views/auth/login.php");
            exit();
        }
    }
   
    }


















?>
<h2>Login</h2>
<!-- TODO: Add login form with input fields for username and password -->
<!-- Add Bootstrap form classes as needed -->
<form method="post" action="../../controllers/auth/login.php">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php include __DIR__.'/../layouts/footer.php'; ?>
