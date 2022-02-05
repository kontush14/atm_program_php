<?php 
    $title="Authorization form"; // Form name
    require __DIR__ . '/header.php'; // add project header
    require "config/db.php"; // connect file to connect to database

    // Create a variable to collect data from the user using the POST method
    $data = $_POST;

    // The user clicks on the "Log in" button and the code starts executing
    if(isset($data['do_login'])) { 

    // Create an array to collect errors
    $errors = array();

    // search for users in the users 'users'
    $user = R::findOne('users', 'card_number = ?', array($data['card_number']));

    if($user) {

        // If the login exists, then check the pin code
        if(password_verify($data['pin_code'], $user->pin_code)) {

            // That`s right, let the user
            $_SESSION['logged_user'] = $user;
            
            // Redirect to main page
                    header('Location: index.php');

        } else {
        
        $errors[] = 'Pin code entered is incorrect!';

        }

    } else {
        $errors[] = 'Bank card with this number not found!';
    }

    if(!empty($errors)) {

            echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';

        }

    }
?>

<div class="container mt-4">
		<div class="row">
			<div class="col">
		<!-- Authorization form -->
		<h2>Authorization form</h2>
		<form action="login.php" method="post">
			<input type="text" class="form-control" name="card_number" id="card_number" placeholder="Enter a card number" required><br>
			<input type="password" class="form-control" name="pin_code" id="pin_code" placeholder="Enter a pin code" required><br>
			<button class="btn btn-success" name="do_login" type="submit">Submit</button>
		</form>
		<br>
		<p><form action="/index.php"><button>Back to home</button></form></p>
			</div>
		</div>
	</div>

<?php require __DIR__ . '/footer.php'; ?> <!-- Connect the footer of the project -->