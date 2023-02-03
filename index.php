<?php 
require("logic/router.php");

if (isset($_GET["route"])) {
    checkROute($_GET["route"]);
}
else {
    checkROute([]);
};

?>