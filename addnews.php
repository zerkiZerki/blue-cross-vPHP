<?php
    if (!isset($_SESSION['users']['valid']) || $_SESSION['users']['valid'] == 'false'){
        header("Location: index.php?menu=6");
    }
    else if($_SESSION['user']['valid'] == 'true'){
    print'
        <h2>NEW ARTICLE</h2>';
        if ($_POST['_action_'] == FALSE) {
            print '
        <div class="container">
            <section class="contact-section my-5">
                <div class="card">
                    <div class="row">
                        <!-- Contact form -->
                        <div class="col-lg-12">
                            <div class="card-body form">
                                <h4 class="mt-4">Add new article</h4>
                                <form class="contact-form" action="" method="POST">
                                    <input type="hidden" id="_action_" name="_action_" value="TRUE">
                                    <input type="text" name="title" class="form-control" placeholder="Title">
                                    <textarea type="text" name="article" rows="5" class="form-control mb-3" placeholder="Story"></textarea>
                                    <input type="file" name="picture" class="form-control" placeholder="Picture">
                                    <button type="submit" name="submit" class="btn btn-warning btn-block">ADD</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <a href="index.php?menu='.$menu.'&amp;action='.$action.'" class="btn btn-info btn-block">Back</a>';
        }
        else if ($_POST['_action_'] == TRUE) {
        $query  = "INSERT INTO news (title, description, picture)";
                $query .= " VALUES ('" . $_POST['title'] . "', '" . $_POST['article'] . "', '" . $_POST['picture'] . "')";
                $result = @mysqli_query($MySQL, $query);
        }
    }
?>