<?php
session_start();
if (empty($_SESSION['id'])) {
  $_SESSION['erro_login'] = "Sessão expirada ou não iniciada. Faça login para continuar.";
  header('Location: login.php');
  exit;
}