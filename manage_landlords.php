<?php
session_start();

$base_url = 'http://localhost/mylandlord';

// Redirect if not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

include_once "header.php";
include_once "classes/Admin.php";

$admin = new Admin();

// Pagination settings
$limit = 10; // landlords per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total landlords count
$total_landlords = $admin->getLandlordCount();
$total_pages = ceil($total_landlords / $limit);

// Get landlords for this page
$landlords = $admin->getLandlordsPaginated($limit, $offset);

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
    $deleteId = $_POST["delete_id"];
    $admin->deleteLandlord($deleteId);
    header("Location: manage_landlords.php?page=$page");
    exit();
}
?>

<style>
    .action-btns form {
        display: inline-block;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center">Manage Landlords</h2>
    <?php if (count($landlords) === 0): ?>
        <p class="mt-4 text-danger">No landlords found.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped table-hover mt-4" border="1">
            <thead class="thead-dark">
                <tr>
                    <th>Serial Number</th>
                    <th>Landlord's Username</th>
                    <th>Landlord's Surname</th>
                    <th>Landlord's First Name</th>
                    <th>Landlord's Middle Name</th>
                    <th>Landlord's Id Number</th>
                    <th>Landlord's Email</th>
                    <th>Landlord's Phone Number</th>
                    <th>Date Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($landlords as $index => $landlord): ?>
                    <tr>
                        <td><?= $offset + $index + 1 ?></td>
                        <td><?= htmlspecialchars($landlord['landlord_username']) ?></td>
                        <td><?= htmlspecialchars($landlord['landlord_surname']) ?></td>
                        <td><?= htmlspecialchars($landlord['landlord_firstname']) ?></td>
                        <td><?= htmlspecialchars($landlord['landlord_middlename']) ?></td>
                        <td><?= htmlspecialchars($landlord['landlord_id']) ?></td>
                        <td><?= htmlspecialchars($landlord['landlord_email']) ?></td>
                        <td><?= htmlspecialchars($landlord['landlord_mobile']) ?></td>
                        <td><?= htmlspecialchars($landlord['date_registered']) ?></td>
                        <td class="action-btns">
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this landlord?');">
                                <input type="hidden" name="delete_id" value="<?= $landlord['landlord_id'] ?>">
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <!-- Bootstrap Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif ?>
    <a href="admin_dashboard.php" class="btn btn-success mt-3">← Back to Dashboard</a>
</div>

<?php include_once "footer.php"; ?>
