<?php
require '../core/functions.php';
require '../config/keys.php';
include '../core/db_connect.php';
require '../core/session.php';

$args=[
  'id'=>FILTER_UNSAFE_RAW,
  'confirm'=>FILTER_VALIDATE_INT
];

$input = filter_input_array(INPUT_GET, $args);
$id=$input['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
$stmt->execute(['id'=>$id]);
$row = $stmt->fetch();

if(!empty($input['confirm'])){
  $stmt = $pdo->prepare("DELETE FROM users WHERE id=:id");
  if($stmt->execute(['id'=>$id])){
    header('Location: /users/');
  }
}

$meta=[];
$meta['title']="DELETE: {$row['first_name']} {$row['last_name']}";

$content=<<<EOT
<h1 class="text-danger text-center">DELETE: {$row['first_name']} {$row['last_name']}</h1>
<p class="text-danger text-center">Are you sure you want to delete {$row['first_name']} {$row['last_name']}?</p>

<div class="text-center">
  <a href="users/" class="btn btn-success btn-lg">Cancel</a>
  <br><br>
  <a href="users/delete.php?id={$row['id']}&confirm=1" class="btn btn-link text-danger">Delete</a>
</div>
EOT;

require '../core/layout.php';