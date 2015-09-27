<?php
namespace vdf\perceive;

class Header implements Views
{
    public function __construct()
    {
        $username = null;
        $userlevel = null;

        // Get username from session variables
        if (!empty($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        // Get userlevel from session variables
        if (!empty($_SESSION['userlevel'])) {
            $userlevel = $_SESSION['userlevel'];
        }

        // Draw the header
        $this->draw($username, $userlevel);
    }


    public function draw($username = null, $userlevel = null)
    {
        // Begin drawing the page
        ?>
        <html>
        <head>
            <title>Perceive Database</title>
            <?php $style = new Style(); ?>
        </head>
        <body>
            <div id="top-banner">
                <div id="inline" style="padding-top: 10px;">
                    PERCEIVE DATABASE
                    <form id="search"><input type="text" placeholder="SEARCH" /></form>
                </div>
                <div id="inline-logo"></div>
            </div>

            <div id="bottom-banner">&copy; Virtual Design Factory</div>
            <div id="user-banner">
        <?php
        // Check the status of the username and userlevel
        if ($username === null && $userlevel === null) {
            echo 'Both username and userlevel are null <br />';
        } else {
            echo 'Welcome ' . $username . '<br />';
            echo 'Role: ' . $userlevel . '<br />';
        }
        ?>

    </div> <?php
    }
}
