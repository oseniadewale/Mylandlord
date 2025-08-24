<?php
session_start();

$base_url = 'http://localhost/mylandlord';

// Redirect if not logged in as admin
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

include_once "header.php";
include_once "classes/Admin.php";
include_once "classes/House.php";

$admin = new Admin();
$house = new House();

// Pagination setup
$limit = 10;
$page = isset($_GET["page"]) && is_numeric($_GET["page"]) ? (int)$_GET["page"] : 1;
$offset = ($page - 1) * $limit;

$houses = $house->getPaginatedHouses($limit, $offset);
$totalHouses = $house->countAllHouses();
$totalPages = ceil($totalHouses / $limit);

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
    $house->deleteHouse($_POST["delete_id"]);
    header("Location: manage_houses.php");
    exit();
}
?>

<style>
    .action-btns form {
        display: inline-block;
    }
</style>

<div class="container mt-5">
    <h2>Manage Houses</h2>
    <?php if (count($houses) === 0): ?>
        <p style="mt-4; color:red">No houses found.</p>
    <?php else: ?>
        <table class="table table-bordered table-hover mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>S/N</th>
                    <th>Type</th>
                    <th>State</th>
                    <th>LGA</th>
                      <th>location</th>
                    <th>Actual Price</th>
                    <th>Landlord Username</th>
                    <th>Availability status</th>
                    <th>Date Posted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($houses as $index => $h): ?>
                    <tr>
                        <td><?= $offset + $index + 1 ?></td>
                        <td><?= $h['house_type'] ?></td>
                        <td><?= $h['state_name'] ?></td>
                        <td><?= $h['lg_name'] ?></td>
                        <td><?= $h['location'] ?></td>
                        <td>₦<?= number_format($h['actual_price']) ?></td>
                        <td><?= $h['landlord_username'] ?? 'N/A' ?></td>
                        <td><?= $h['availability_status'] ?></td>
                         <td><?= $h['Date_Updated'] ?></td>
                        
                        <td class="action-btns">
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this house?');">
                                <input type="hidden" name="delete_id" value="<?= $h['house_id'] ?>">
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                          
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

       <nav aria-label="Page navigation">
    <ul class="pagination">

        <?php
        // Limit the number of page links shown
        $maxPagesToShow = 10;
        $startPage = max(1, $page - floor($maxPagesToShow / 2));
        $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);

        // Adjust start page if we're at the end
        if ($endPage - $startPage + 1 < $maxPagesToShow) {
            $startPage = max(1, $endPage - $maxPagesToShow + 1);
        }
        ?>

        <!-- First Button (only show if not already in range) -->
        <?php if ($startPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=1">⇐ First</a>
            </li>
        <?php endif; ?>

        <!-- Prev Button -->
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>">← Prev</a>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- Next Button -->
        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1 ?>">Next →</a>
            </li>
        <?php endif; ?>

        <!-- Last Button (only show if not already in range) -->
        <?php if ($endPage < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $totalPages ?>">Last ⇒</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>

    <?php endif ?>
    <a href="admin_dashboard.php" class="btn btn-success mt-3">← Back to Dashboard</a>
</div>

<?php include_once "footer.php"; ?>
