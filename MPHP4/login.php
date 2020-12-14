
<html>
<head>
    <style>
        form{
            display: grid;
            grid-auto-columns: auto auto;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
<form method="post" action="loginverwerken.php">
    <label for="username">Voer hier uw username in</label>
    <input type="text" name="username">

    <label for="password">Voer hier uw password in</label>
    <input type="text" name="password">

    <input type="submit" name="submit">
    <div class="g-recaptcha" data-sitekey="6Lf7HuIZAAAAAHk8znXsbfaXP5eDIwHyRcV1J_lZ"></div>
</form>

</body>
</html>
