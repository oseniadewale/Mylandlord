<?php
session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";


include_once "classes/House.php";

if (!isset($_SESSION["tenant_id"])) {
    header("Location: tenant_signup_form3.php");
    exit();
}
$number = 1;
$searchKey = isset($_GET['q']) ? trim($_GET['q']) : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

$houseObj = new House();
$houses = $houseObj->searchHouses($searchKey, $limit, $offset);
$totalHouses = $houseObj->countSearchHouses($searchKey);
$totalPages = ceil($totalHouses / $limit);

function highlight($text, $searchKey)
{
    if (!$searchKey)
        return htmlspecialchars($text);
    return preg_replace(
        "/(" . preg_quote($searchKey, '/') . ")/i",
        "<span style='color:blue; font-weight:bold;'>$1</span>",
        htmlspecialchars($text)
    );
}
?>

<div class="container-fluid mt-4">
    <h3 style="display:flex; justify-content:center";>Search results for: <span style="color:blue"><?= htmlspecialchars($searchKey) ?></span></h3>
    <p style="display:flex; justify-content:center">Found: <b style="margin-left:5px"><?= $totalHouses ?></b> result(s)</p>

    <?php if ($totalHouses == 0): ?>
        <div class="alert alert-danger">No houses matched your search.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped" border="1">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>House Type</th>
                    <th>Landlord</th>
                    <th>Landlord Mobile</th>
                    <th>Landlord Surname</th>
                                        <th>Landlord Firstname</th>
                    <th>State</th>
                    <th>LG</th>
                    <th>Location</th>
                    <th>Features</th>
                    <th>More Details on house</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($houses as $house): ?>
                    <tr>
                        <td><?php echo $number++ ?></td>
                        <td><?= highlight($house['house_type'], $searchKey) ?></td>
                        <td><?= highlight($house['landlord_username'], $searchKey) ?></td>
                        <td><?= highlight($house['landlord_mobile'], $searchKey) ?></td>
                        <td><?= highlight($house['landlord_surname'], $searchKey) ?></td>
                        <td><?= highlight($house['landlord_firstname'], $searchKey) ?></td>
                        <td><?= highlight($house['state_name'], $searchKey) ?></td>
                        <td><?= highlight($house['lg_name'], $searchKey) ?></td>
                        <td><?= highlight($house['location'], $searchKey) ?></td>
                        <td><?= highlight($house['house_features'], $searchKey) ?></td>
                        <td>
                            <a href="more_details_on_house.php?house_id=<?= $house['house_id']; ?>" class="btn btn-success">
                                Click here
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($totalPages > 1): ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?q=<?= urlencode($searchKey) ?>&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-6" style="display:flex; justify-content:start; margin-left:5px;">
            <a href="tenant_dashboard.php" class="btn btn-success"> ← Back to Dashboard</a>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
</div>





<?php  include_once __DIR__ . "/footer.php" ?>