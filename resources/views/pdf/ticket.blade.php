<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; color: #333; line-height: 1.6; padding: 20px; }
        .container { width: 100%; max-width: 700px; margin: 0 auto; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        
        .header { background-color: #343a40; color: #fff; padding: 15px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .header p { margin: 5px 0 0; font-size: 16px; opacity: 0.8; }

        .section-title { font-size: 18px; color: #343a40; border-bottom: 2px solid #343a40; padding-bottom: 8px; margin-top: 30px; margin-bottom: 20px; }

        .details-grid { display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 20px; }
        .details-grid > div { flex: 1; min-width: 45%; padding: 10px; box-sizing: border-box; }
        .details-grid strong { color: #555; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #e9ecef; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; }
        
        .total-row { background-color: #343a40; color: #fff; font-weight: bold; }
        .total-row td { border-color: #343a40; }

        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Confirmation de Réservation</h1>
            <p>Billet N°: {{ $booking->booking_number }}</p>
        </div>

        <div style="padding: 20px;">
            <div class="section-title">Informations du Client</div>
            <div class="details-grid">
                <div>
                    <strong>Nom :</strong> {{ $booking->user->name ?? 'N/A' }}<br>
                    <strong>Email :</strong> {{ $booking->user->email ?? 'N/A' }}
                </div>
                <div>
                    <strong>Téléphone :</strong> {{ $booking->user->phone ?? 'N/A' }}<br>
                    <strong>Adresse :</strong> {{ $booking->user->address ?? 'N/A' }}
                </div>
            </div>

            <div class="section-title">Détails du Véhicule et de la Location</div>
            <table>
                <tr>
                    <th>Description</th>
                    <th>Détails</th>
                </tr>
                <tr>
                    <td>Véhicule</td>
                    <td>{{ $booking->car->brand }} {{ $booking->car->model }}</td>
                </tr>
                <tr>
                    <td>Date de début</td>
                    <td>{{ $pickup->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Date de fin</td>
                    <td>{{ $return->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Nombre de jours</td>
                    <td>{{ $booking->total_days }} jour(s)</td>
                </tr>
                <tr>
                    <td>Prix par jour</td>
                    <td>{{ number_format($booking->price_per_day, 2) }} MAD</td>
                </tr>
                <tr class="total-row">
                    <td>TOTAL</td>
                    <td>{{ number_format($booking->total_price, 2) }} MAD</td>
                </tr>
                
            </table>
        </div>
    </div>
</body>
</html>