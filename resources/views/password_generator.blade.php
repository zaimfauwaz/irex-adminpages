<!-- resources/views/password_generator.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
</head>
<body>
    <h1>Password Generator</h1>

    <form action="{{ route('generate.password') }}" method="POST">
        @csrf
        <label for="plaintext_password">Enter Plaintext Password:</label>
        <input type="password" name="plaintext_password" id="plaintext_password" required>
        <button type="submit">Generate Hashed Password</button>
    </form>

    @if (isset($hashedPassword))
        <h2>Generated Hashed Password:</h2>
        <textarea rows="4" cols="50">{{ $hashedPassword }}</textarea>
        <h3>Plaintext Password:</h3>
        <textarea rows="4" cols="50" readonly>{{ $plaintextPassword }}</textarea>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
