<?php
namespace vdf\perceive;

class Style implements Views
{
    public function __construct()
    {
        $this->draw();
    }

    public function draw()
    {
        ?>

        <style>
        body {
            padding-top: 100px;
            font-family: sans-serif;
            background-image: url('images/truss heels.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
        #top-banner {
            text-align: center;
            color: white;
            font-size: 35px;
            width: 100%;
            height: 100px;
            background-color: black;
            opacity: 0.8;
            position: absolute;
            top: 0px;
            left: 0px;
        }

        #bottom-banner {
            text-align: center;
            color: white;
            font-size: 20px;
            width: 100%;
            height: 25px;
            background-color: black;
            opacity: 0.8;
            position: absolute;
            bottom: 0px;
            left: 0px;
        }

        #user-banner {
            color: white;
            padding-top: 25px;
            padding-left: 10px;
            font-size: 20px;
            position: absolute;
            top: 0px;
            left: 0px;
        }

        #inline {
            display: inline-block;
            vertical-align: top;
        }

        #inline-logo {
            display: inline-block;
            vertical-align: top;
            width: 100px;
            height: 100px;
            background-image: url('images/perceive.png');
        }

        #search input[type=text] {
            color: white;
            background-color: grey;
            text-align: center;
            width: 250px;
            font-size: 25px;
            height: 40px;
            border: solid;
            border-width: 3px;
            border-radius: 4px;
            border-color: white;
            transition: box-shadow 0.5s;
        }

        #search input[type=text]:hover, #search input[type=text]:focus {
            box-shadow: 0 0 8px white;
            outline: none;
        }
        </style>

        <?php
    }
}
