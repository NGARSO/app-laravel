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
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            width: 90%;
            max-width: 500px;
            transition: transform 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h1 {
            font-size: 26px;
            margin-bottom: 1rem;
            color: #4caf50;
        }

        p {
            font-size: 18px;
            margin-bottom: 2rem;
        }

        .icon {
            font-size: 70px;
            color: #4caf50;
            margin-bottom: 1rem;
        }

        .footer {
            margin-top: 2rem;
            font-size: 14px;
            color: #777;
        }

        .button {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fas fa-check-circle icon"></i>
        <h1>Utilisateur Créé</h1>
        <p>Félicitations ! L'utilisateur <strong>{{ $user->name }}</strong> a été créé avec succès.</p>
        <a href="{{ route('users.index') }}" class="button">Retour à la liste des utilisateurs</a>
        <div class="footer">
            <p>Merci de votre attention !</p>
        </div>
    </div>
</body>
</html>