<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Réinitialisation du mot de passe</title>
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #ffffff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .header {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: #333;
      padding-bottom: 10px;
      border-bottom: 2px solid #333;
    }
    .content {
      margin-top: 20px;
      font-size: 18px;
      line-height: 1.6;
    }
    .button {
      display: inline-block;
      background-color: #007bff;
      color: #ffffff;
      padding: 12px 20px;
      margin: 20px 0;
      text-align: center;
      text-decoration: none;
      font-size: 18px;
      border-radius: 5px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      💢 Réinitialisez votre mot de passe 💢
    </div>
    <div class="content">
      <p>Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe:</p>
      <a href="http://localhost:5173/reset-password/{{$token}}" class="button">
        Réinitialiser le mot de passe
      </a>
    </div>
  </div>

</body>
</html>
