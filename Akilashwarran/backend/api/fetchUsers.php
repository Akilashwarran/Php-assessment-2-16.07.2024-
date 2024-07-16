<?php
require '../config/Database.php';
require '../models/User.php';

$db = (new Database())->getConnection();
$user = new User($db);

$search = $_POST['search'] ?? '';
$sort = $_POST['sort'] ?? 'username_asc';
$page = $_POST['page'] ?? 1;
$limit = 4;
$offset = ($page - 1) * $limit;

// Parse sort option
$sortColumn = 'username';
$sortOrder = 'ASC';
if ($sort === 'username_desc') {
    $sortOrder = 'DESC';
} elseif ($sort === 'email_desc') {
    $sortColumn = 'email';
    $sortOrder = 'DESC';
} elseif ($sort === 'email_asc') {
    $sortColumn = 'email';
    $sortOrder = 'ASC';
}

$users = $user->getUsersWithLimit($offset, $limit, $search, $sortColumn, $sortOrder);
foreach ($users as $userData) {
    echo "<div class='bg-green-500 item flex items-center border border-gray-300 rounded-lg mb-2 p-3 min-h-[100px]'>
            <img src='../uploads/{$userData['avatar']}' alt='Avatar' class='w-16 h-16 mr-4 rounded-full'>
            <div class='item-details flex-grow'>
                <h3 class='text-white font-bold'>{$userData['username']}</h3>
                <p class='text-white'>{$userData['email']}</p>
            </div>
            <a href='profile.php?id={$userData['id']}' class='bg-red-500 text-white rounded px-6 py-2 hover:bg-red-600 transition'>View</a>
        </div>";
}

$totalUsers = $user->getTotalUsers($search);
$totalPages = ceil($totalUsers / $limit);

echo "<div id='pagination' class='self-center mt-5'>";
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='#' class='pagination-link mx-1 px-3 py-1 border border-gray-400 rounded hover:bg-lime-300 hover:text-white transition duration-200' data-page='$i'>$i</a>";
}
echo "</div>";
?>
