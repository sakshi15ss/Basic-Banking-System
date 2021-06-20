<!DOCTYPE html>
<html>
<head>
<title>Transaction history</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Gabriela&display=swap" rel="stylesheet">
    <style>

        table {
            border-collapse: collapse;
            width: 100%;
            color:black;
            font-size: 25px;
            text-align: left;
        }
        th {
            background-color:purple;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2}

        #sideNav{
            width: 250px;
            height: 100vh;
            position: fixed;
            right: -250px;
            top:0;
            background:purple;
            z-index: 2;
            transition: .5s;
        }
        nav ul li{
            list-style: none;
            margin: 50px 20px;
        }
        nav ul li a{
            text-decoration: none;
            color: #fff;
        }
        #menuBtn{
            width: 50px;
            position: fixed;
            right: 65px;
            top: 35px;
            z-index: 2;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div style="font-family: 'Fantasy', serif;   font-size: 40px;
        text-align: center;
        margin: 20px;
    }">TRANSACTION HISTORY</div>
    <table>
    <tr>
    <th>SENDER</th>
    <th>ACCOUNT NO.</th>
    <th>RECEIVER</th>
    <th>ACCOUNT NO. </th>
    <th>AMOUNT</th>
    </tr>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "sakshi";

        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn){
            die("Sorry we failed to connect: ". mysqli_connect_error());
        }


        $sql = "SELECT * FROM `transfer`";
        $result = mysqli_query($conn, $sql);

        
        $num = mysqli_num_rows($result);
        if($num> 0){
            

            
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>" . $row["s_name"]. "</td><td>" . $row["s_acc_no"] . "</td>
                <td>" . $row["r_name"] . "</td><td>" . $row["r_acc_no"] . "</td><td>" . $row["amount"] . "</td><td>" . "</td>";
                 echo "</tr>";
        }
        echo "</table>";
        }
    ?>


    <nav id="sideNav">
        <ul>
            <li><a href="index.html">HOME</a></li>
            <li><a href="users.php">OUR CUSTOMERS</a></li>
            <li><a href="history.php">TRANSACTION HISTORY</a></li>
            <li><a href="users.php">TRANSFER MONEY</a></li>
            <li><a href="register.php">NEW USER</a></li>
        </ul>
    </nav>
    <div id="done">
        <img src="images/mn.png" id="menuBtn">
    </div>

    <script>
        let menuBtn = document.querySelector('#done');
        let sideNav = document.querySelector('#sideNav')
        let condition = true;
        menuBtn.addEventListener('click',function(){
            if(condition){
                 sideNav.style.right = '0px';
                 condition = false;
            }
            else{
                sideNav.style.right = '-250px';
                condition = true;
            }
            })
    </script>
    </table>
    </body>
</html>