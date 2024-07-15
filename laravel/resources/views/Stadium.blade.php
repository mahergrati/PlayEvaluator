<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Stade</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
            background-image: url('{{ asset('images/photo.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            color: #333;
        }
        h1 {
            color: #333;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<div class="form-container">
    <form id="stadiumForm" action="{{ route('stadium.add') }}" method="POST">
        @csrf
        <label for="name">Nom du stade</label>
        <input type="text" name="name" id="name" required>
        <label for="address">Adresse</label>
        <input type="text" name="address" id="address" required>
        <label for="availability">Disponibilité</label>
        <input type="date" name="availability" id="availability" required>
        <label for="phone_number">Numéro de téléphone</label>
        <input type="text" name="phone_number" id="phone_number" required>
        <label for="price">Prix</label>
        <input type="text" name="price" id="price" required>
        <button type="submit">Ajouter</button>
    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("availability")[0].setAttribute('min', today);

        document.getElementById('name').addEventListener('change', function() {
            var stadiumName = this.value;
            var availabilityInput = document.getElementById('availability');

            // Fetch existing dates for the selected stadium
            fetch(`/api/stadium-dates?name=${stadiumName}`)
                .then(response => response.json())
                .then(data => {
                    var unavailableDates = data.dates;
                    var dateInput = availabilityInput;
                    dateInput.setAttribute('min', today);
                    dateInput.addEventListener('input', function() {
                        if (unavailableDates.includes(this.value)) {
                            this.setCustomValidity('La date est déjà prise pour ce stade.');
                        } else {
                            this.setCustomValidity('');
                        }
                    });
                });
        });
    });
</script>
</body>
</html>
