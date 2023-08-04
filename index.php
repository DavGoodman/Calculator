<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="number" name="num01" placeholder="Number One">
        <select name="operator">
            <option value="add">+</option>
            <option value="sub">-</option>
            <option value="mul">*</option>
            <option value="div">/</option>
        </select>
    <input type="number" name="num02" placeholder="Number Two">
    <button type="submit">Calculate</button>
    </form>


    <?php 
    
    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        //Get input data
        $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
        $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);

        //Error handlers
        $errors = false;

        if(empty($num01) || empty($num02) || empty($operator)) {
            echo "<p>Please fill all the fields</p>";
            $errors = true;
        }

        if(!is_numeric($num01) || !is_numeric($num02)) {
            echo "<p>Please enter a valid number</p>";
            $errors = true;
        }

        //If there are no errors, calculate the result
        $value = null;
        if(!$errors) {
            switch($operator) {
                case "add":
                    $value = $num01 + $num02;
                    break;
                case "sub":
                    $value = $num01 - $num02;
                    break;
                case "mul":
                    $value = $num01 * $num02;
                    break;
                case "div":
                    $value = $num01 / $num02;
                    break;
                default:
                    echo "Something went wrong";
            }

            echo $value === null ? "NA" : "<p>The result is: $value</p>" ;
        }

    }
    
    ?>
    
</body>
</html>