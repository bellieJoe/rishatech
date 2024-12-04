<?php

class Session {
    public static function getUser() {
        return $_SESSION['user'] ?? null;
    }
}
