
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOGIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="parentcontainer relative bg-cover bg-center min-h-screen" style="background-image: url('https://wallpaperaccess.com/full/10994372.jpg');">
        <div class="login absolute mt-32 p-6 rounded shadow-lg bg-white bg-opacity-10 backdrop-blur-md border border-white border-opacity-20">
            <div class="loginheader mb-4">
                <h1 class="font-bold text-2xl" id="head1">ADMINISTRATION LOGIN</h1>
            </div>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf <!-- CSRF token for security -->
                <div class="username">
                    <label for="username" class="block mb-1 font-semibold">Email</label>
                    <input type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded" value="{{ old('username') }}">
                </div>

                <div class="password">
                    <label for="password" class="block mb-1 font-semibold mt-1.5">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded">
                </div>
                @if ($errors->any())
                    <p class="text-red-600 text-sm mt-2">{{ $errors->first() }}</p>
                @endif
                <button type="submit" class="bg-gray-900 text-white py-2 px-4 rounded hover:bg-gray-800 ml-24 mt-3.5">Submit</button>
            </form>                    
        </div>
    </div>
</body>
</html>