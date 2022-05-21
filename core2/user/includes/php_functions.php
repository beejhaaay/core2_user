<?php
session_start();

function login_session_check()
{
    if (isset($_SESSION['acc_type'])) {
        if ($_SESSION['acc_type'] == 'SuperUser') {
            header('location: AdministratorAcc/SuMainPage.php');
        }
    }
}

function session_check()
{
    if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] == '') {
        header('location: ../login.php');
    }
}

function dept_check()
{
    if (isset($_SESSION['dept'])) {
        if ($_SESSION['dept'] == "testing" && $_SESSION['user_type'] == "admintester") {
            return $_SESSION['user_type'];
        } elseif ($_SESSION['dept'] == "testing" && $_SESSION['user_type'] == "tester") {
            return $_SESSION['user_type'];
        }
    }
}

function dash_body_content()
{
    if (isset($_GET['content'])) {
        $tent = $_GET['content'];
        switch ($tent) {
            case 'icons':
                echo '<script>$("#body_content").load("demo/icons.php");</script>';
                break;
        }
    } else {
        choose_content();
    }
}

function choose_content()
{
    if (dept_check() == "admintester") {
        echo '
        <script>
            $("#body_content").load("testfolder/testdashb.php");
        </script>
        ';
    } elseif (dept_check() == "tester") {
        echo '
        <script>
            $("#body_content").load("testfolder/testdashb.php");
        </script>
        ';
    } elseif (dept_check() == "demo_tester") {
        echo '
        <script>
            $("#body_content").load("demo/maincontent.php");
        </script>
        ';
    }
}

function sidebar_content()
{
    if (dept_check() == "admintester" || dept_check() == "tester") {
        include "testfolder/test_sidebar.php";
    }
}

function navbar_content()
{
    if (dept_check() == "admintester") {
        include "testfolder/test_navbar.php";
    } elseif (dept_check() == "tester") {
        include "testfolder/test_navbar.php";
    }
}

function call_content()
{
    // $conn = mysqli_connect("bcpsupport.site", "bcpsuppo_test", "*#g)mM#!)wa{", "bcpsuppo_remote_test");
    require 'includes/db.php';
    $role = $_SESSION['user_type'];
    $sql = "select * from testnav where role='$role';";
    $query = mysqli_query($conn, $sql);

    while ($rows = mysqli_fetch_assoc($query)) {
        if ($rows['li_type'] == 'link') {
            echo '
            <li id="' . $rows['element_id'] . '" class="' . $rows['element_classes'] . '">
                <a href="' . $rows['href'] . '"><i class="' . $rows['icon_classes'] . '"></i>' . $rows['link_name'] . '</a>
            </li>
            ';
            continue;
        } elseif ($rows['li_type'] == 'dropdown' && $rows['dropdown_tag'] == '') {
            echo '
            <li class="">
                <a href="' . $rows['href'] . '" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="' . $rows['icon_classes'] . '"></i>' . $rows['link_name'] . '</a>
                <ul class="collapse list-unstyled" id="' . $rows['element_id'] . '">
            ';
            $ddid = $rows['element_id'];
            call_content_dropdown($ddid);
            echo '
                </ul>
            </li>
            ';
        }
    }
    echo '
    <li><a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    ';
}

function call_content_dropdown($ddid)
{
    // $conn = mysqli_connect("bcpsupport.site", "bcpsuppo_test", "*#g)mM#!)wa{", "bcpsuppo_remote_test");
    require 'includes/db.php';
    $role = $_SESSION['user_type'];
    $sql = "select * from testnav where role='$role' and dropdown_tag='$ddid';";
    $query = mysqli_query($conn, $sql);

    while ($ddlrows = mysqli_fetch_assoc($query)) {
        if ($ddlrows['li_type'] == 'dropdown') {
            echo '
            <li class="">
                <a href="' . $ddlrows['href'] . '" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="' . $ddlrows['icon_classes'] . '"></i>' . $ddlrows['link_name'] . '</a>
                <ul class="collapse list-unstyled" id="' . $ddlrows['element_id'] . '">
            ';
            $ddid = $ddlrows['element_id'];
            call_content_dropdown($ddid, $ddlrows);
            echo '
                </ul>
            </li>
            ';
        } elseif ($ddlrows['li_type'] == 'dropdown_link') {
            echo '
            <li id="' . $ddlrows['element_id'] . '" class="' . $ddlrows['element_classes'] . '">
                <a href="' . $ddlrows['href'] . '"><i class="' . $ddlrows['icon_classes'] . '"></i>' . $ddlrows['link_name'] . '</a>
            </li>
            ';
        }
    }
}

function logmeout()
{
    session_unset();
    session_destroy();
}

function query_emplinfo()
{
    // $conn = mysqli_connect("bcpsupport.site", "bcpsuppo_test", "*#g)mM#!)wa{", "bcpsuppo_remote_test");
    require 'includes/db.php';
    $sql = 'select * from test_users where empl_idno="' . $_SESSION['user'] . '";';
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($query);
    return $rows;
}
