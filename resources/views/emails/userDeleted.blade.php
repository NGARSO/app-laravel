<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification de Suppression d'Utilisateur</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            width: 90%;
            max-width: 500px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 1rem;
        }

        p {
            font-size: 16px;
            margin-bottom: 2rem;
        }

        .icon {
            font-size: 50px;
            color: #4caf50;
            margin-bottom: 1rem;
        }

        .footer {
            margin-top: 2rem;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fas fa-check-circle icon"></i>
        <h1>Utilisateur Supprimé</h1>
        <p>L'utilisateur <strong>{{ $user->name }}</strong> a été supprimé avec succès.</p>
        <div class="footer">
            <p>Merci de votre attention !</p>
        </div>
    </div>
</body>
</html>