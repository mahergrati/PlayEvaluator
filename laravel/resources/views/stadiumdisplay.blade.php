<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Stades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f0f0;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
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
        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .btn-group button {
            flex: 1;
            margin: 5px;
        }
        .action-buttons {
            display: flex;
            justify-content: flex-start;
        }
        .action-buttons form {
            margin-right: 5px;
        }
        #form-container {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Liste des Stades</h1>
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <div class="btn-group">
        <button onclick="showForm('add')">Add Stadium</button>
    </div>
    <table>
        <thead>
        <tr>
            <th>Nom du stade</th>
            <th>Adresse</th>
            <th>Disponibilité</th>
            <th>Numéro de téléphone</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($stadiums as $stadium)
            <tr>
                <td>{{ $stadium->name }}</td>
                <td>{{ $stadium->address }}</td>
                <td>{{ \Carbon\Carbon::parse($stadium->availability)->format('d/m/Y') }}</td>
                <td>{{ $stadium->phone_number }}</td>
                <td>{{ $stadium->price }} €</td>
                <td class="action-buttons">
                    <button onclick="showForm('update', {{ $stadium }})">Update</button>
                    <form action="{{ route('stadium.delete', $stadium->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Aucun stade n'a été ajouté pour le moment.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div id="form-container">
        <form id="stadium-form" action="{{ route('stadium.add') }}" method="POST">
            @csrf
            <input type="hidden" id="form-method" name="_method" value="POST">
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
            <button type="submit" id="form-submit">Ajouter</button>
        </form>
    </div>
</div>

<script>
    function showForm(action, stadium = null) {
        var formContainer = document.getElementById('form-container');
        var form = document.getElementById('stadium-form');
        var methodInput = document.getElementById('form-method');
        var submitButton = document.getElementById('form-submit');

        form.reset();
        formContainer.style.display = 'block';
        if (action === 'add') {
            form.action = '{{ route('stadium.add') }}';
            methodInput.value = 'POST';
            submitButton.textContent = 'Ajouter';
        } else if (action === 'update') {
            form.action = '/stadiums/' + stadium.id;
            methodInput.value = 'PUT';
            submitButton.textContent = 'Mettre à jour';

            // Populate the form with the stadium data
            document.getElementById('name').value = stadium.name;
            document.getElementById('address').value = stadium.address;
            document.getElementById('availability').value = stadium.availability;
            document.getElementById('phone_number').value = stadium.phone_number;
            document.getElementById('price').value = stadium.price;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("availability")[0].setAttribute('min', today);
    });
</script>
</body>
</html>
