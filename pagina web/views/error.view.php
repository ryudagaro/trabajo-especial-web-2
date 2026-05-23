<?php
class errorview {
    public function renderError($msg) {
        echo "<h1>Error</h1>";
        echo "<p>$msg</p>";
        echo "<a href='home'>Volver al inicio</a>";
    }
}