<?php
function assert_global_uniqueness($pdo, $username, $email, $mobile) {
    $sql = "
        SELECT 'tenant_username' AS field FROM tenant WHERE tenant_username = :username
        UNION
        SELECT 'landlord_username' FROM landlord WHERE landlord_username = :username
        UNION
        SELECT 'tenant_email' FROM tenant WHERE tenant_email = :email
        UNION
        SELECT 'landlord_email' FROM landlord WHERE landlord_email = :email
        UNION
        SELECT 'tenant_mobile' FROM tenant WHERE tenant_mobile = :mobile
        UNION
        SELECT 'landlord_mobile' FROM landlord WHERE landlord_mobile = :mobile
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':email'    => $email,
        ':mobile'   => $mobile
    ]);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        $labels = [
            'tenant_username'   => 'username',
            'landlord_username' => 'username',
            'tenant_email'      => 'email address',
            'landlord_email'    => 'email address',
            'tenant_mobile'     => 'phone number',
            'landlord_mobile'   => 'phone number',
        ];

        $messages = [];
        foreach ($rows as $row) {
            $fieldLabel = $labels[$row['field']] ?? 'field';
            $messages[] = "This {$fieldLabel} is already taken.";
        }
            $implosion = implode(" ", $messages);
            $new_instruction = "Use another one(s) please";
            $way_forward = $implosion." ".$new_instruction;
        // Combine into one exception message
        throw new Exception($way_forward);
    }
}
