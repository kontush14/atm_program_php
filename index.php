<?php
    $title="Home page"; // form name
    require __DIR__ . '/header.php'; // add project header
    require "config/db.php"; //  connect file to connect to database
?>

<div class="container mt-4">
<div class="row">
<div class="col">
<center>
<h1>Welcome to the web atm!</h1>
</center>
</div>
</div>
</div>

<!-- If logged in will display a greeting -->
<?php if(isset($_SESSION['logged_user'])) : ?>
	<form action="/balance.php"><button>View balance card</button></form></br>
    <form action="/withdraw_cash.php"><button>Withdraw cash</button></form></br>

<!-- User can click log out to log out -->
<form action="/logout.php"><button>Log out</button></form> <!-- файл logout.php создадим ниже -->
<?php else : ?>

<!-- If the user is not authorized, it will display a link to authorization -->
<form action="/login.php"><button>Bank card authorization</button></form><br>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?> <!-- add project footer -->