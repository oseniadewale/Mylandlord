<?php
session_start();

$base_url = 'http://localhost/landlord';

// Redirect if not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

include_once "header.php";
include_once "classes/Admin.php";

$admin = new Admin();

// Pagination setup
$limit = 10; // Tenants per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get tenants with pagination
$tenants = $admin->getTenantsWithLimit($limit, $offset);

// Get total tenants count
$total_tenants = $admin->getTenantsCount();
$total_pages = ceil($total_tenants / $limit);

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
    $deleteId = $_POST["delete_id"];
    $admin->deletetenant($deleteId);
    header("Location: manage_tenants.php?page=$page");
    exit();
}
?>

<style>
    .action-btns form {
        display: inline-block;
    }
</style>

<div class="container mt-5">
    <p style="color:green;display:flex; justify-content:center; font-size:24px">Manage tenants:</p>
    <?php if (count($tenants) === 0): ?>
        <p class="mt-4" style="color:red">No tenants found.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped table-hover mt-4" border="1">
            <thead class="thead-dark">
                <tr>
                    <th>Serial Number</th>
                    <th>Username</th>
                    <th>Surname</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Tenant's Id Number</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Date Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tenants as $index => $tenant): ?>
                    <tr>
                        <td><?= $offset + $index + 1 ?></td>
                        <td><?= htmlspecialchars($tenant['tenant_username']) ?></td>
                        <td><?= htmlspecialchars($tenant['tenant_surname']) ?></td>
                        <td><?= htmlspecialchars($tenant['tenant_firstname']) ?></td>
                        <td><?= htmlspecialchars($tenant['tenant_middlename']) ?></td>
                        <td><?= htmlspecialchars($tenant['tenant_id']) ?></td>
                        <td><?= htmlspecialchars($tenant['tenant_email']) ?></td>
                        <td><?= htmlspecialchars($tenant['tenant_mobile']) ?></td>
                        <td><?= htmlspecialchars($tenant['date_registered']) ?></td>
                        <td class="action-btns">
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this tenant?');">
                                <input type="hidden" name="delete_id" value="<?= $tenant['tenant_id'] ?>">
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
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
