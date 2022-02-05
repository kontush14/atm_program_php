<?php
    $title="Withdraw Cash"; // Form name
    require __DIR__ . '/header.php'; // add project header
    require "config/db.php"; // connect file to connect to database
    require "model/cashmachine.php"; // connecting a file with a cash withdrawal model 
?>

<!-- If logged in will display a greeting -->
<?php if(isset($_SESSION['logged_user'])) : ?>
    <form action="withdraw_cash.php" method="post">
        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter the amount" required><br>
        <button class="btn btn-success" name="do_amount" type="submit">Submit</button>
    </form></br>

<!--Shows how much money was withdrawn-->
<h3>The amount of cash withdrawn: <?php echo $_POST['amount']; ?> UAH</h3><br> 

<!--Shows which banknotes were withdrawn-->
<h4>Explanation: [bill]=>number of banknotes</h4>
<br>
<pre><?php
    /*This is a check: if you specify a larger amount to withdraw cash than is on the balance,the system
     will give an error. If the amount is less, the system will issue cash and reduce the balance by the amount withdraw
    */
    if($_POST['amount'] > $_SESSION['logged_user']->balance)
    {
        echo "<h3>Insufficient amount on card balance, enter a valid number</h3>";
    }
    else 
    {
        if($_POST['amount'] > 1)
    {
        $atm = new CashMachine;
        print_r($atm->getBills($_POST['amount']));
        

        /* Balance change
        We substract the amount from the balance by changing the amount of the balance in the database
        When checking the balance, the amount will decrease. 
        */
        $id = $_SESSION['logged_user'];
        //Loading an object from ID bank card
        $money = R::load('users', $id);
        //Access the property and assign a new value to it  
        $money->balance = $money->balance - $_POST['amount'];
        //Save the object
        R::store($money);
    }
    elseif($_POST['amount'] <= 1)
    {
        echo '<h1>Enter a valid number</h1>';
    }
    }
?>
</pre>

<!-- User can click log out to log out -->
<form action="/logout.php"><button>Log out</button></form> 
<?php else : ?>

<!-- If the user is not authorized, it will display a link to authorization -->
<form action="/login.php"><button>Bank card authorization</button></form><br>
<?php endif; ?>

<?php

?>

<?php require __DIR__ . '/footer.php'; ?> <!-- add project footer -->