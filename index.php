<?php
$errors = [];
$fields = ['name', 'address', 'email', 'time', 'course', 'agree'];
$optionalFields = ['agree'];
$values = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($fields as $field) {
    if (empty($_POST[$field]) && !in_array($field, $optionalFields)) {
      $errors[] = $field;
    } else {
      $values[$field] = $_POST[$field];
    }
  }

  if (empty($errors)) {
    foreach ($fields as $field) {
      if ($field === "course") {
        printf("%s: %s<br />", $field, var_export($_POST[$field], TRUE));
      } else {
        printf("%s: %s<br />", $field, $_POST[$field]);
      }
    }
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <style type="text/css">
    body {
      background-color: #FAFAF9;
      color: #111827;
      padding: 15px;
    }
    h1, h2 {
      margin-bottom: 10px;
    }
    h2 {
      margin-top: 10px;
    }
    .wrapper {
      background-color: #155084;
      color: #ffffff;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      width: 95%;
      padding: 15px;
      border-radius: 5px;
    }
    .wrapper div:last-child {
      grid-column: 2;
    }
    label, .field-label {
      padding-top: 10px;
      text-align: right;
    }
    input {
      padding: 10px 10px 10px 5px;
    }
    input, option {
      color: #1F2937;
      font-size: 1.1rem;
    }
    .error {
      color: #FF0000;
    }
  </style>
</head>
<body>
<h1>Admission Form</h1>
<h2>Different Types of Courses</h2>
<form class="wrapper" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="name">Name</label>
  <div>
    <input type="text"
           name="name"
           id="name"
           value="<?php echo htmlspecialchars($values['name']);?>">

    <?php if (in_array('name', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <label for="address">Address</label>
  <div>
    <input type="text"
           name="address"
           id="address"
           value="<?php echo htmlspecialchars($values['address']);?>">

    <?php if (in_array('address', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <label for="email">Email</label>
  <div>
    <input type="text"
           name="email"
           id="email"
           value="<?php echo htmlspecialchars($values['email']);?>">

    <?php if (in_array('email', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <div class="field-label">Which time do you Comfortable?</div>
  <div>
    <label>
      <input type="radio"
             name="time"
             <?php if (isset($values['time']) && $values['time'] == "morning") echo "checked"; ?>
             value="morning">
      Morning
    </label>
    <label>
      <input type="radio"
             name="time"
             <?php if (isset($values['time']) && $values['time'] == "evening") echo "checked"; ?>
             value="evening">
      Evening
    </label>
    <label>
      <input type="radio"
             name="time"
             <?php if (isset($values['time']) && $values['time'] == "afternoon") echo "checked"; ?>
             value="afternoon">
      Afternoon
    </label>
    <label>
      <input type="radio"
             name="time"
             <?php if (isset($values['time']) && $values['time'] == "othertime") echo "checked"; ?>
            value="othertime">
      Other Time
    </label>

    <?php if (in_array('time', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <label for="course">Course Name</label>
  <div>
    <select name="course[]" id="course" size="4" multiple="">
      <?php
      $options = ["HTML", "Java", "Python", "PHP", "C#", "C++", ".Net", "Nodejs", "Pascal", "R", "Ruby", "Mongodb"];
      foreach ($options as $option) {
        printf(
          '<option value="%s" %s>%s</option>',
          $option,
          (in_array($option, $values['course'])) ? "selected" : '',
          ucfirst($option)
        );
      }
      ?>
    </select>
    <?php if (in_array('course', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <label for="agree">Would you like a agree?</label>
  <div>
    <input type="checkbox"
           name="agree"
           id="agree"
           <?php if (isset($values['agree']) && $values['agree'] == "Yes") echo "checked"; ?>
           value="Yes">
  </div>
  <div>
    <input type="submit" name="submit" value="Submit">
  </div>
</form>
</body>
</html>