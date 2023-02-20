<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Multiple Select Dropdown in PHP</title>

        <style>
            .myform-container{
                width: 600px;
                margin: 50px auto;
            }
            
            .myform-container select{
                width: 300px;
            }
        </style>

    </head>
    <body>

        <div class="myform-container">


            <form action="" method="post" class="mb-3">
                <h3>Choose your favorite languages</h3>
                <select name="lang[]" multiple class="form-control">
                    <option value=""disabled selected>Choose option</option>
                    <option value="Laravel">Laravel</option>
                    <option value="Php">Php</option>
                    <option value="Jquery">Jquery</option>
                    <option value="Node Js">NodeJs</option>
                    <option value="Bootstrap">Bootstrap</option>
                </select>

                <div>
                    <br>
                    <input type="submit" name="submit" vlaue="Choose options">
                </div>

            </form>

            <?php
            if (isset($_POST['submit'])) {
                if (!empty($_POST['lang'])) {
                    foreach ($_POST['lang'] as $selected) {
                        echo '<p class="select-tag mt-3">' . $selected . '</p>';
                    }
                } else {
                    echo '<p class="error alert alert-danger mt-3">Please select any value</p>';
                }
            }
            ?>

        </div>

    </body>
</html>