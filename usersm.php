<?php
    if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false'){
        header("Location: index.php?menu=6");
    }
    else if($_SESSION['user']['valid'] == 'true'){
        if (isset($_POST['edit']) && $_POST['_action_'] == 'TRUE') {
            $query  = "UPDATE user SET user_name='" . $_POST['name'] . "', user_surname='" . $_POST['surname'] . "', user_username='" . $_POST['username'] . "', user_email='" . $_POST['email'] . "', user_country='" . $_POST['country'] . "', user_archive='" . $_POST['archive'] . "',user_role='" . $_POST['role'] . "'";
            $query .= " WHERE user_id=" . (int)$_POST['edit'];
            $query .= " LIMIT 1";
            $result = @mysqli_query($MySQL, $query);
            # Close MySQL connection
            @mysqli_close($MySQL);
            
            #$_SESSION['message'] = '<p>You successfully changed user profile!</p>';
            
            # Redirect
            header("Location: index.php?menu=9&action=1");
        }
        if (isset($_GET['delete']) && $_GET['delete'] != '') {
            if ($_SESSION['user']['role'] == 1) {
            $query  = "DELETE FROM user";
            $query .= " WHERE user_id=".(int)$_GET['delete'];
            $query .= " LIMIT 1";
            $result = @mysqli_query($MySQL, $query);

            #$_SESSION['message'] = '<p>You successfully deleted user profile!</p>';
            
            # Redirect
            header("Location: index.php?menu=9&action=1");
            }
        }
        if (isset($_GET['user']) && $_GET['user'] != '') {
            $query  = "SELECT * FROM user";
            $query .= " WHERE user_id=".$_GET['user'];
            $result = @mysqli_query($MySQL, $query);
            $row = @mysqli_fetch_array($result);
            print '
            <h2>User profile # ' . $row['user_id'] . '</h2>
            <table class="table table-hover table-responsive-lg">
            <tbody>
                <tr>
                    <th scope="row"><p><b>Name:</b></p></th>
                    <td scope="row"><p> ' . $row['user_name'] . '</p></td>
                </tr>
                <tr>
                    <th scope="row"><p><b>Surname:</b></p></th>
                    <td scope="row"><p> ' . $row['user_surname'] . '</p></td>
                </tr>
                <tr>
                    <th scope="row"><p><b>Username:</b></p></th>
                    <td scope="row"><p> ' . $row['user_username'] . '</p></td>
                </tr>
                <tr>
                    <th scope="row"><p><b>Country:</b></p></th>
                    <td name="country">';
                    $_query  = "SELECT * FROM country";
                    $_query .= " WHERE country_id='" . $row['user_country'] . "'";
                    $_result = @mysqli_query($MySQL, $_query);
                    $_row = @mysqli_fetch_array($_result, MYSQLI_ASSOC);
                    print $_row['country_name'] . '</td>
                </tr>
                <tr>
                    <th scope="row"><p><b>Date:</b></p></th>
                    <td scope="row"><p> ' . pickerDateToMysql($row['user_modified']) . '</p></td>
                </tr> 
            </tbody>
            </table>
            <p><a href="index.php?menu='.$menu.'&amp;action='.$action.'" class="btn btn-info btn-block">Back</a></p>';
        }
        else if (isset($_GET['edit']) && $_GET['edit'] != '') {
            if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2) {
                $query  = "SELECT * FROM user";
                $query .= " WHERE user_id=".$_GET['edit'];
                $result = @mysqli_query($MySQL, $query);
                $row = @mysqli_fetch_array($result);
                $checked_archive = false;
                
                print '
                <h2>Edit user profile</h2>
                <section class="contact-section my-5">
                <div class="card">
                    <div class="row">
                        <!-- Register-->
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card-body form">
                                <h3 class="mt-4">User profile # ' . $row['user_id'] . ' </h3>
                                <form class="contact-form" action="" name="registration_form" method="POST">
                                    <input type="hidden" id="_action_" name="_action_" value="TRUE">
                                    <input type="hidden" id="edit" name="edit" value="' . $_GET['edit'] . '">
                                    <input type="text" name="username" class="form-control userpass" value="' . $row['user_username'] . '" placeholder="Username" required>
                                    <input type="text" name="name" class="form-control" value="' . $row['user_name'] . '" placeholder="Name" required>
                                    <input type="text" name="surname" class="form-control" value="' . $row['user_surname'] . '"placeholder="Surname" required>
                                    <input type="text" name="email" class="form-control" value="' . $row['user_email'] . '"placeholder="e-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                    <select name="country" class="form-control">
                                        <option value="">Select country</option>';
                                        $_query  = "SELECT * FROM country";
                                        $_result = @mysqli_query($MySQL, $_query);
                                        while($_row = @mysqli_fetch_array($_result)) {
                                            print '<option value="' . $_row['country_id'] . '"';
                                            if ($row['user_country'] == $_row['country_id']) { print ' selected'; }
                                            print '>' . $_row['country_name'] . '</option>';
                                        }
                                    print '
                                    </select>';
                                    if ($_SESSION['user']['role'] == 1) {
                                        print'
                                        <select name="role" class="form-control">
                                            <option value="">Select user role</option>';
                                            $_query  = "SELECT * FROM role";
                                            $_result = @mysqli_query($MySQL, $_query);
                                            while($_row = @mysqli_fetch_array($_result)) {
                                                print '<option value="' . $_row['role_id'] . '"';
                                                if ($row['user_role'] == $_row['role_id']) { print ' selected'; }
                                                print '>' . $_row['role'] . '</option>';
                                            }
                                        }
                                    print '
                                    </select>
                                    <label for="archive">Archive:</label><br />
                                    <input type="radio" name="archive" value="Y"'; if($row['user_archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> YES &nbsp;&nbsp;
                                    <input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NO                
                                    <button type="submit" name="submit" class="btn btn-warning btn-block">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';
            print'
                <a href="index.php?menu='.$menu.'&amp;action='.$action.'" class="btn btn-info btn-block">Back</a>';
            }
            else {
                print '<p>Zabranjeno</p>';
            }
        }
        else{
        print'
        <h2>List of users</h2>
        <table class="table table-hover table-responsive-lg">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">email</th>
                    <th scope="col">Conutry</th>
                    <th></th>';
                    if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2){
                        print'
                    <th></th>';
                    }
                    if ($_SESSION['user']['role'] == 1){
                        print'
                    <th></th>';
                    }
                    print'
                </tr>
            </thead>
            <tbody>';
            $query  = "SELECT * FROM user";
            $result = @mysqli_query($MySQL, $query);
            while($row = @mysqli_fetch_array($result)) {
                print '
                <tr>
                    <th scope="row">' . $row['user_id'] . '</th>
                    <td><strong>' . $row['user_name'] . '</strong></td>
                    <td><strong>' . $row['user_surname'] . '</strong></td>
                    <td>' . $row['user_email'] . '</td>
                    <td>';
                        $_query  = "SELECT * FROM country";
                        $_query .= " WHERE country_id='" . $row['user_country'] . "'";
                        $_result = @mysqli_query($MySQL, $_query);
                        $_row = @mysqli_fetch_array($_result, MYSQLI_ASSOC);
                        print $_row['country_name'] . '
                    </td>
                    <td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;user=' .$row['user_id']. '"><i class="fas fa-user btn btn-info"></a></i></td>';
                    if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2){
                        print'
                    <td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['user_id']. '"><i class="fas fa-edit btn btn-warning"></a></i></td>';
                    }
                    if ($_SESSION['user']['role'] == 1){
                        print'
                    <td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['user_id']. '"><i class="fas fa-trash-alt btn btn-danger"></a></i></td>';
                    }
                    print'              
                </tr>';
                }
                print'
            </tbody>
        </table>';
        }
    }
    @mysqli_close($MySQL);
?>