<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #004D40;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #004D40;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .payment-details {
            margin: 20px 0;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .payment-details p {
            margin: 10px 0;
            font-size: 14px;
            color: #333;
        }

        .payment-details p strong {
            color: #004D40;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #004D40;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <h1>Confirmation de Paiement</h1>
        </div>

        <!-- Corps de l'e-mail -->
        <div class="content">
            <h2>Bonjour <?php echo htmlspecialchars($notifiable->name, ENT_QUOTES, 'UTF-8'); ?>,</h2>

            <p>Nous vous remercions pour votre confiance. Votre paiement a été traité avec succès.</p>
            <p>Voici les détails de votre transaction :</p>

            <!-- Détails du paiement -->
            <div class="payment-details">
                <p><strong>Numéro de transaction :</strong> <?php echo htmlspecialchars($displayId, ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Date :</strong> <?php echo htmlspecialchars($date, ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Montant :</strong> <span style="color: #38b2ac; font-weight: bold;">$<?php echo htmlspecialchars($amount, ENT_QUOTES, 'UTF-8'); ?> USD</span></p>
                <p><strong>Statut :</strong> <span style="background-color: #c6f6d5; color: #2f855a; padding: 4px 12px; border-radius: 20px; font-size: 12px;"><?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></span></p>
            </div>

            <!-- Bouton d'action -->
            <a href="<?php echo $paymentUrl; ?>" class="button">Voir le détail de la transaction</a>

            <!-- Message de fin -->
            <p>Si vous avez des questions concernant votre paiement, notre équipe d'assistance est à votre disposition.</p>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <p>Cordialement,<br>L'équipe <?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </div>
</body>

</html>