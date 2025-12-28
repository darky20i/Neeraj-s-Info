<!DOCTYPE html>
<html>
<head>
<title>	NEERAJ'S NUMBER INFO Tool</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="glass">
  <h2>NEERAJ'S NUMBER INFO Tool</h2>

  <button onclick="selectType('mobile')">📱 Mobile Lookup</button>
  <button onclick="selectType('vehicle')">🚗 Vehicle Lookup</button>
  <button onclick="selectType('id')">🆔 ID Lookup</button>

  <input id="input" placeholder="Select option first">
  <button class="check" onclick="check()">Check</button>

  <div class="result" id="result"></div>
</div>

<script src="script.js"></script>
</body>
</html>
