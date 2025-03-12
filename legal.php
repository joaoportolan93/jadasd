<?php
require 'db.php';

$action = $_REQUEST['action'] ?? '';

switch($action) {
    case 'create':
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
        break;

    case 'read':
        $stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
        $users = $stmt->fetchAll();
        
        echo '<div class="list-group">';
        foreach($users as $user) {
            echo '<div class="list-group-item d-flex justify-content-between align-items-center">';
            echo '<div>';
            echo '<h5>'.$user['name'].'</h5>';
            echo '<small>'.$user['email'].'</small>';
            echo '</div>';
            echo '<span class="badge bg-secondary">'.date('d/m/Y H:i', strtotime($user['created_at'])).'</span>';
            echo '</div>';
        }
        echo '</div>';
        break;
}
?>