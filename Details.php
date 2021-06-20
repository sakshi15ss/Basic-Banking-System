<!DOCTYPE html>
<html>

<head>
  <title>Database</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Gabriela&display=swap" rel="stylesheet">
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      color: black;

      font-size: 25px;
      text-align: left;
    }

    th {
      background: purple;
      color: white;
    }

    tr:nth-child(even) {
      background-color: thistle
    }

    #sideNav {
      width: 250px;
      height: 100vh;
      position: fixed;
      right: -250px;
      top: 0;
      background:purple;
      z-index: 2;
      transition: .5s;
    }

    nav ul li {
      list-style: none;
      margin: 50px 20px;
    }

    nav ul li a {
      text-decoration: none;
      color: #fff;
    }

    #menuBtn {
      width: 50px;
      position: fixed;
      right: 65px;
      top: 35px;
      z-index: 2;
      cursor: pointer;
    }


    .card {
      box-shadow: 0 4px 10px  0 ;
      transition: 0.3s;
      text-align: -webkit-center;
    }
    }

    .card:hover {
      box-shadow: 0 8px 16px lavender;
    }

    .container {
      padding: 20px 16px;
      margin: 40px;
      background: thistle;
    }
  </style>
</head>

<body>


  <table>
    <tr>
      <th>Account Number</th>
      <th>Name</th>
      <th>Email</th>
      <th>Gender</th>
      <th>Balance</th>

    </tr>


    <?php
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($server, $username, $password, "sakshi");
    if (!$conn) {
      die("Connection failed");
    }

    $_SESSION['user'] = $_GET['user'];
    $_SESSION['sender'] = $_SESSION['user'];


    ?>
    <?php
    if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];

      $sql = "SELECT * FROM users WHERE Name='$user'";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";

        echo "<td>" . $row["Sr.No"] . "</td><td>" . $row["Name"] . "</td>
              <td>" . $row["Email"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["Balance"] . "</td>";

        echo "</tr>";
      }
    }
    ?>
    <div style="font-family: 'Cursive', serif;   font-size: 40px;
    text-align: center;
    margin: 20px;
}">
      <h3>Make a Transaction</h3>
    </div>
    <div class="card container">
      <?php
      if ($_GET['message'] == 'success') {
        echo "<h3><p style='color:green;' class='messagehide'>Transaction  completed </p></h3>";
      }
      if ($_GET['message'] == 'transactionDenied') {
        echo "<h3><p style='color:red;' class='messagehide'>Transaction Failed </p></h3>";
      }
      ?>
      <form action="transfer.php" method="POST">

        <b>To</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp
        <select name="reciever" id="dropdown" class="textbox" required>
          <option>Select Recipient</option>
          <?php
          $db = mysqli_connect("localhost", "root", "", "sakshi");
          $res = mysqli_query($db, "SELECT * FROM users WHERE name!='$user'");
          while ($row = mysqli_fetch_array($res)) {
            echo ("<option> " . "  " . $row['Name'] . "</option>");
          }
          ?>
        </select>
        <br><br>
        <b> From</b>&nbsp&nbsp&nbsp&nbsp :&nbsp&nbsp <span style="font-size:1.2em;"><input id="myinput" name="sender" class="textbox" disabled type="text" value='<?php echo "$user"; ?>'></input></span>
        <br><br>


        <b>Amount :&#8377;</b>
        <input name="amount" type="number" min="100" class="textbox" required>
        <br><br>
        <a href="transfer.php"><button id="transfer" name="transfer" ;>Transfer</button></a>
      </form>
    </div>

    <div style="font-family: 'Cursive', serif;   font-size: 40px;
    text-align: center;
    margin: 20px;
}">
      <h3>Customer Details</h3>
    </div>


    <nav id="sideNav">
      <ul>
        <li><a href="index.html">HOME</a></li>
        <li><a href="users.php">OUR CUSTOMERS</a></li>
        <li><a href="history.php">TRANSACTION HISTORY</a></li>
        <li><a href="users.php">TRANSFER MONEY</a></li>
        <li><a href="register.php">NEW USER</a></li>
      </ul>
    </nav>
    <div id="hojaplz">
      <img src="images/mn.png" id="menuBtn">
    </div>




    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script>
      let menuBtn = document.querySelector('#hojaplz');
      let sideNav = document.querySelector('#sideNav')

      let condition = true;

      menuBtn.addEventListener('click', function() {
        if (condition) {
          sideNav.style.right = '0px';
          condition = false;
        } else {
          sideNav.style.right = '-250px';
          condition = true;
        }
      })


      $(function() {
        setTimeout(function() {
          $('.messagehide').fadeOut('slow');
        }, 3000);
      });
    </script>