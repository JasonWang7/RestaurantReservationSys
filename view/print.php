<?php /*****vince****/ ?>
<body onload="window.print()">

<div style="width:600px; margin:auto; border-style: outset; text-align:center;">
<img src="https://i.imgur.com/VMDg9Dc.png"></img>
<p>___________________________________</p>
<?php
echo '<h2>Restaurant Name: ' . $_GET['name'] . '</h2>';
echo '<h2>Reservation ID: ' . $_GET['id'] . '</h2>';
echo '<h2>Time: ' . $_GET['time'] . '</h2>';
echo '<h2>Number of Guests: ' . $_GET['guests'] . '</h2>';
echo '<h2>Phone: ' . $_GET['phone'] . '</h2>';
?>
</div>

</body>
