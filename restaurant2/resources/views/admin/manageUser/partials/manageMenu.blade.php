<div class="mothercontainer">
    <div class="Managemenu header text-center">
        <h1 class="font-bold text-2xl text-center" id="head1">MANAGE USER</h1>
            </div>


<div class="btnmother flex flex-col items-center space-y-4">
     <a href="{{ route('admin.users.index') }}" id="btn1" class="Button w-64 py-3 bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105 flex items-center justify-center">
  View Users
</a>

  <a href="{{ route('admin.users.create') }}" id="btn2" class="Button w-64 py-3 bg-green-600 hover:bg-green-700 text-white text-lg font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105 flex items-center justify-center">
  Create New Users
</a>

</div>
</div>
