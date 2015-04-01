<body onload="window.print()">

<div style="width:500px; margin:auto; border-style: outset; text-align:center;">
<img src="https://i.imgur.com/VMDg9Dc.png"></img>
___________________________________
<?php
echo '<h1>Restaurant Name: ' . $_GET['name'] . '</h1>';
echo '<h1>Reservation ID: ' . $_GET['id'] . '</h1>';
echo '<h1>Time: ' . $_GET['time'] . '</h1>';
echo '<h1>Number of Guests: ' . $_GET['guests'] . '</h1>';
echo '<h1>Phone: ' . $_GET['phone'] . '</h1>';

?>
</div>

</body>
