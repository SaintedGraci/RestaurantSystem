<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="/css/style2.css">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <title>Document</title>
</head>
<body>

<div class="mothercontainer">
    <div class="Managemenu header text-center">
        <h1 class="font-bold text-2xl text-center" id="head1">MANAGE USER</h1>
            </div>
   <div class="dashboard absolute top-5 right-6 p-2 rounded shadow-lg bg-white bg-opacity-10 backdrop-blur-md border border-white border-opacity-20" id="dashboard">
    <a href="{{ route('admin.dashboard') }}" class="text-blue-600" style="font-family: 'Poppins', sans-serif;">Back to Dashboard</a>
</div>


<div class="btnmother flex items-center space-x-20">
     <a href="{{ route('admin.users.index') }}" id="btn1" class="Button relative inline-block rounded-lg shadow-md 
                      bg-blue-600 hover:bg-blue-700 
                      border border-blue-700 
                      text-white text-sm font-medium font-inter cursor-pointer 
                      transition duration-200 hover:scale-105">
  View Users
</a>


  <a href="{{ route('admin.users.create') }}" id="btn2" class="Button relative inline-block rounded-lg shadow-md 
                      bg-blue-600 hover:bg-blue-700 
                      border border-blue-700 
                      text-white text-sm font-medium font-inter cursor-pointer 
                      transition duration-200 hover:scale-105">
  Create New Users
</a>

</div>
</div>
</body>
</html>