<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>User List</title>
</head>
<body class="bg-gray-100 overflow-hidden">
    <div class="container mx-auto pt-10 flex">
        <div class="bg-white shadow-md rounded-lg p-5 w-1/4">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Users List</h3>
            <form id="filterForm" method="POST" action="" class="flex flex-col space-y-4">
                <input id="searchInput" type="text" name="search" placeholder="Search users" class="border border-gray-300 rounded px-4 py-2">
                <select id="sortSelect" name="sort" class="border border-gray-300 rounded px-4 py-2">
                    <option value="username_asc">Sort by Username Ascending</option>
                    <option value="username_desc">Sort by Username Descending</option>
                    <option value="email_asc">Sort by Email Ascending</option>
                    <option value="email_desc">Sort by Email Descending</option>
                </select>
            </form>
        </div>
        <div id="userList" class="bg-white shadow-md rounded-lg p-5 ml-5 w-3/4 max-h-[calc(100vh-80px)] overflow-y-auto"></div>
    </div>

    <script>
        $(document).ready(function() {
            function loadUsers(page = 1) {
                const formData = $('#filterForm').serialize() + '&page=' + page;
                $.ajax({
                    url: '../api/fetchUsers.php',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        $('#userList').html(data);
                    }
                });
            }

            $('#searchInput').on('keypress', function(e) {
                if (e.which === 13) { 
                    e.preventDefault();
                    loadUsers();
                }
            });

            $('#sortSelect').on('change', function() {
                loadUsers();
            });

            $(document).on('click', '.pagination-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                loadUsers(page);
            });

            
            loadUsers();
        });
    </script>
</body>
</html>
