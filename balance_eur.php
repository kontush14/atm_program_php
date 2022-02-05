<?php
    $title="Balance bank card"; // Form name
    require __DIR__ . '/header.php'; // add project header
    require "config/db.php"; // connect file to connect to database
    require "model/foreign_currency.php";
?>

<!-- If you sign in, your bank card balance will be dispalyed -->
<?php if(isset($_SESSION['logged_user'])) : ?>
	 <h3>Your card balance: 
     <?php
        $get = new ForeignCurrency;//Create an instance of the class ForeignCurrency 
        $EUR = $get->getCurrencyEUR();//access to the property getCurrencyEUR()
        echo $EUR * $_SESSION['logged_user']->balance;//display balance cards in euros
    ?> USD</h3></br>

<!-- User can click back to menu and return to the main menu -->
<form action="/index.php"><button>Back to menu</button></form><br>
<!-- User can click log out to log out -->
<form action="/logout.php"><button>Log out</button></form><br> 
<?php else : ?>

<!-- If the user is not authorized, it will display a link to authorization -->
<form action="/login.php"><button>Bank card authorization</button></form><br>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?> <!-- add project footer -->